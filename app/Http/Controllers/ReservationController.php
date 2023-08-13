<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Coupon;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\ReservationPaymentService;

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


    /*
     * Process of checking out the reservation using stripe.
     */
    public function payment(ReservationPaymentService $reservationPaymentService)
    {

        $roomsBooked = session('reservation_rooms');
        $billingData = session('billingData');

        $paymentUrl = $reservationPaymentService->processPayment($roomsBooked, $billingData);
        return redirect($paymentUrl);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationPaymentService $reservationPaymentService)
    {
        $checkIn = \Carbon\Carbon::parse(session("checkInDate"));
        $checkOut = \Carbon\Carbon::parse(session("checkOutDate"));
        $billingData = session('billingData');


        $totalPaid_MMK = $reservationPaymentService->calculateSubTotal(session('reservation_rooms'), 'MMK');
        $coupon = $reservationPaymentService->checkForCoupon($billingData);

        if ($coupon) {
            $totalPaid_MMK = $reservationPaymentService->applyCoupon($totalPaid_MMK, $coupon, 'MMK');
            $coupon->useCoupon();
        }

        $invoiceData = [
            'coupon_id' => $coupon->id,
            'total_paid_mmk' => $totalPaid_MMK,
            'pay_type_id' => $billingData['payment_method'],
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

        $reservation = null;
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
