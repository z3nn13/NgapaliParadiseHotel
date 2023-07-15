<?php

namespace App\Http\Controllers;

use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /*
     * Display rooms to be reserved.
     */
    public function index(Request $request)
    {
        // 
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create(Request $request)
    {
        if ($request->has("goBack")) {
            return view('booking.create');
        }

        $dealChoice = RoomDeal::find($request->input("roomDealID"));
        $roomChoice = RoomType::find($request->input("roomTypeID"));
        $request->session()->put('dealChoice', $dealChoice);
        $request->session()->put('roomChoice', $roomChoice);
        return view('booking.create');
    }

    /**
     * Show the form for creating a new booking.
     */
    public function confirm(Request $request)
    {
        return view('booking.confirm');
    }

    /**
     * Process of checking out the .
     */
    public function payment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));

        $roomTypes = [session('roomChoice')];
        $roomDeal = session('roomDeal');

        $checkIn = \Carbon\Carbon::parse(session('checkInDate'));
        $checkOut = \Carbon\Carbon::parse(session('checkOutDate'));
        $numNights = $checkIn->diffInDays($checkOut);
        $totalAmount = $roomDeal->deal_mmk * $numNights;

        $roomsBooked = $roomTypes;
        foreach ($roomsBooked as $room) {
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => 'mmk',
                        'product_data' => [
                            'name' => $room->room_type_name,
                            "description" => $room->description,
                        ],
                        'unit_amount_decimal' => $totalAmount * 100,
                    ],
                    'quantity' => 1,
                ]
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('booking.success'),
            'cancel_url' => route('booking.index'),
        ]);

        return redirect($session->url);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function success(Request $request)
    {
        $request->session()->flush();
        return view('booking.success');
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        //
    }


    /**
     * Display a single booking (ADMIN).
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
