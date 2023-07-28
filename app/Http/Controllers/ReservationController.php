<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\PayType;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    /**
     * Show the form for creating a new booking.
     */
    public function create(Request $request)
    {
        if ($request->has("goBack")) {
            return view('booking.create');
        }

        $dealChoice = RoomDeal::find($request->input("roomDealID"));
        $roomTypeChoice = RoomType::find($request->input("roomTypeID"));
        $roomAssigned = Room::find($request->input("roomID"));

        $reservation_room = [
            'roomDeal' => $dealChoice,
            'roomType' => $roomTypeChoice,
            'roomAssigned' => $roomAssigned,
        ];
        $request->session()->push('reservation_rooms', $reservation_room);
        $request->session()->save();
        return view('booking.create');
    }


    /**
     * Show the form for creating a new booking.
     */
    public function confirm(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->session()->put('billingData', $request->all());
        }
        return view('booking.confirm');
    }


    /**
     * Process of checking out the reservation.
     */
    public function payment(Request $request)
    {

        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $roomsBooked = session('reservation_rooms');
        $billingData = session('billingData');
        $currency = $billingData['currency'];
        $couponID = $billingData['couponID'] ?? null;
        $lineItems = [];



        foreach ($roomsBooked as $room) {
            $price = $currency == "USD" ? $room['roomDeal']->deal_usd : $room['roomDeal']->deal_mmk;

            // Retrieve the coupon from the database
            if ($couponID) {
                $coupon = Coupon::find($couponID);
                $price -= $price * $coupon->discount_amount;
            }

            $lineItems[] = [
                'price_data' => [
                    'currency' => $currency,
                    'product_data' => [
                        'name' => $room["roomType"]->room_type_name,
                        "description" => $room["roomDeal"]->deal_name,
                    ],
                    'unit_amount' =>  $price * 100,
                ],
                'quantity' => 1,
            ];
        }


        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'customer_email' => $billingData['email'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('booking.store'),
            'cancel_url' => route('booking.confirm'),
        ]);

        return redirect($session->url);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $checkIn = \Carbon\Carbon::parse(session("checkInDate"));
        $checkOut = \Carbon\Carbon::parse(session("checkOutDate"));
        $billingData = session('billingData');
        $reservation = null;

        $totalAmount = collect(session('reservation_rooms'))->sum(function ($room) {
            return $room['roomDeal']->deal_mmk;
        });
        $coupon_id = $billingData['coupon_id'] ?? null;
        if ($coupon_id) {
            $coupon = Coupon::find($coupon_id);
            $totalAmount -= $totalAmount * $coupon->discount_amount;
        }

        $invoiceData = [
            'coupon_id' => $coupon_id,
            'pay_type_id' => $billingData['payment_method'],
            'total_paid_mmk' => $totalAmount,
            'preferred_currency' => $billingData['currency'],
        ];


        $reservationData = [
            'user_id' => auth()->id(),
            'num_guests' => session("numGuests"),
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'special_request' => session("specialRequest"),
            'status' => 'Upcoming',
            'first_name' => $billingData['first_name'],
            'last_name' => $billingData['last_name'],
            'country' => $billingData['country'],
            'phone_no' => $billingData['phone_no'],
            'email' => $billingData['email'],
        ];
        DB::transaction(
            function () use (&$reservation, $invoiceData, $reservationData) {
                $reservation = Reservation::create($reservationData);

                $invoiceData['reservation_id'] = $reservation->id;
                $reservation->invoice()->create($invoiceData);

                foreach (session('reservation_rooms') as $room) {
                    $reservation->rooms()->attach($room["roomAssigned"]->id, ["room_deal_id" => $room["roomDeal"]->id]);
                }
            }
        );
        if (Auth::guest()) {
            session()->flush();
        } else {
            session()->forget("checkInDate");
            session()->forget("checkOutDate");
            session()->forget("numGuests");
            session()->forget("numNights");
            session()->forget("reservation_rooms");
        }
        return view('booking.success')->with('reservationData', $reservation);
    }

    public function add_room()
    {
        return view('booking.search');
    }
}
