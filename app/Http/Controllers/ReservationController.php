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
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Process of checking out the .
     */
    public function checkout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('stripe.sk'));

        $roomsBooked = [];
        foreach ($request->room_ids as $room_type_id) {
            $roomsBooked[] = RoomType::find($room_type_id);
        }
        $deal = RoomDeal::find($request->deal_id);
        foreach ($roomsBooked as $room) {
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => 'mmk',
                        'product_data' => [
                            'name' => $room->room_type_name,
                            "description" => $room->description,
                        ],
                        'unit_amount' => $deal->deal__mmk,
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
    public function success()
    {
        return view('index');
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
