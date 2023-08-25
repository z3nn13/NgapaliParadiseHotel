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

        $dealChoice = RoomDeal::find($request->roomDealID);
        $roomTypeChoice = RoomType::find($request->roomTypeID);
        $roomAssigned = Room::find($request->roomID);

        $reservation_room = [
            'roomDeal' => $dealChoice,
            'roomType' => $roomTypeChoice,
            'roomAssigned' => $roomAssigned,
        ];
        session()->push('booking.reservation_rooms', $reservation_room);
        session()->save();
        return view('booking.create');
    }


    /**
     * Show the form for creating a new booking.
     */
    public function confirm()
    {
        return view('booking.confirm');
    }


    /*
     * Process of checking out the reservation using stripe.
     */
    public function payment(ReservationPaymentService $reservationPaymentService)
    {

        $roomsBooked = session('booking.reservation_rooms');
        $billingData = session('booking.billingData');

        $paymentUrl = $reservationPaymentService->processPayment($roomsBooked, $billingData);
        if ($paymentUrl) {
            return redirect($paymentUrl);
        }
        abort(400, 'Sorry, something went wrong with your payment process. Please wait a few moments and try again');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationPaymentService $reservationPaymentService)
    {

        $checkIn = session("booking.checkInDate");
        $checkOut = session("booking.checkOutDate");
        $billingData = session('booking.billingData');



        $totalPaidMMK = $reservationPaymentService->calculateSubTotal(session('booking.reservation_rooms'), 'MMK');

        $coupon = $billingData['coupon'];
        if ($coupon) {
            $totalPaidMMK = $reservationPaymentService->applyCoupon($totalPaidMMK, $coupon, 'MMK');
            $coupon->useCoupon();
        }

        $invoiceData = [
            'coupon_id' => $coupon->id,
            'total_paid_mmk' => $totalPaidMMK,
            'pay_type_id' => $billingData['paymentMethod'],
            'preferred_currency' => $billingData['preferredCurrency'],
        ];


        $reservationData = [
            'user_id' => auth()->id(),
            'num_guests' => session("booking.numGuests"),
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'special_request' => session("booking.specialRequest"),
            'status' => 'Upcoming',
            'first_name' => $billingData['firstName'],
            'last_name' => $billingData['lastName'],
            'country' => $billingData['country'],
            'phone_no' => $billingData['phoneNo'],
            'email' => $billingData['email'],
        ];

        $reservation = null;
        DB::transaction(
            function () use (&$reservation, $invoiceData, $reservationData) {
                $reservation = Reservation::create($reservationData);

                $invoiceData['reservation_id'] = $reservation->id;
                $reservation->invoice()->create($invoiceData);

                foreach (session('booking.reservation_rooms') as $room) {
                    $reservation->rooms()->attach(
                        $room["roomAssigned"]->id,
                        ["room_deal_id" => $room["roomDeal"]->id]
                    );
                }
            }
        );

        session()->forget("booking");
        return view('booking.success', compact('reservation'));
    }


    public function add_room()
    {
        return view('booking.search');
    }
}
