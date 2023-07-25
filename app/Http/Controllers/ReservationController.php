<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomDeal;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

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
        session()->forget('reservation_rooms');
        session()->push('reservation_rooms', $reservation_room);
        return view('booking.create');
    }

    /**
     * Show the form for creating a new booking.
     */
    public function confirm(Request $request)
    {
        return view('booking.confirm', ['billingData' => $request->all()]);
    }

    /**
     * Process of checking out the .
     */
    public function payment(Request $request)
    {

        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $roomsBooked = session('reservation_rooms');


        foreach ($roomsBooked as $room) {

            // $description = "Room Deal: " . $roomDeal->deal_name . "\n" . session('numNights') . ' Nights ' . session('numGuests') . ' Guests';
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => $request->currency,
                        'product_data' => [
                            'name' => $room["roomType"]->room_type_name,
                            "description" => $room["roomDeal"]->deal_name,
                        ],
                        'unit_amount' => $request->totalAmount * 100,
                    ],
                    'quantity' => 1,
                ]
            ];
        }

        $session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('booking.store'),
            'cancel_url' => route('index'),
        ]);

        return redirect($session->url);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $checkIn = \Carbon\Carbon::parse(session("checkInDate"));
        $checkOut = \Carbon\Carbon::parse(session("checkOutDate"));

        $reservation = null;
        DB::transaction(
            function () use ($checkIn, $checkOut, &$reservation) {
                $reservation = Reservation::create(
                    [
                        'user_id' => auth()->id(),
                        'num_guests' => session("numGuests"),
                        'check_in_date' => $checkIn,
                        'check_out_date' => $checkOut,
                        'special_request' => session("specialRequest"),
                        'status' => 'active',
                    ]
                );

                foreach (session('reservation_rooms') as $room) {
                    $reservation->rooms()->attach($room["roomAssigned"]->id, ["room_deal_id" => $room["roomDeal"]->id]);
                }
                session()->forget("checkInDate");
                session()->forget("checkOutDate");
                session()->forget("numGuests");
                session()->forget("numNights");
                session()->forget("reservation_rooms");
            }
        );
        return view('booking.success')->with('reservationData', $reservation);
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
