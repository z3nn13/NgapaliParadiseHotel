<?php

namespace App\Http\Controllers;

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
        return view('booking.confirm', ['billingData' => $request->all()]);
    }

    /**
     * Process of checking out the .
     */
    public function payment(Request $request)
    {

        $stripe = new \Stripe\StripeClient(config('stripe.sk'));
        $roomTypes = [session('roomChoice')];
        $roomDeal = session('dealChoice');
        $description = "Room Deal: " . $roomDeal->deal_name . "\n" . session('numNights') . ' Nights ' . session('numGuests') . ' Guests';


        $roomsBooked = $roomTypes;
        foreach ($roomsBooked as $room) {
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => $request->currency,
                        'product_data' => [
                            'name' => $room->room_type_name,
                            "description" => $description,
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
            'cancel_url' => route('booking.index'),
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

        DB::transaction(function () use ($checkIn, $checkOut) {
            $reservation = Reservation::create(
                [
                    'user_id' => auth()->id(),
                    'num_guests' => session("numGuests"),
                    'check_in_date' => $checkIn,
                    'check_out_date' => $checkOut,
                    'special_request' => session("specialRequest"),
                    'status' => 'Active',
                ]
            );
            $room_to_deal_array = session("room_to_deal_array");
            foreach ($room_to_deal_array as $room => $deal) {
                $reservation->rooms->attach($room, ["room_deal_id" => $deal]);
            }
            session()->forget("checkInDate");
            session()->forget("checkOutDate");
            session()->forget("numGuests");
            session()->forget("numNights");
            session()->forget("roomChoice");
            session()->forget("dealChoice");
        });

        return redirect('booking.success')->with('success', "Reservation created successfully");
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
