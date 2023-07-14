<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    /*
     * Display rooms to be reserved.
     */
    public function index(Request $request)
    {
        $checkInDate = $request['arrivalDate'];
        $checkOutDate = $request['departureDate'];
        $periodOfStay = [$checkInDate, $checkOutDate];


        /*  TODO: Build Test Case
            $testInDate = Carbon::createFromFormat('Y-m-d',  '2023-07-13');
            $testOutDate = Carbon::createFromFormat('Y-m-d',  '2023-07-16');
            $periodOfStay = [$testInDate, $testOutDate];

            SELECT room_type_id, COUNT(*)
            FROM rooms
                WHERE NOT EXISTS (
                SELECT 1
                FROM reservations_rooms
                JOIN reservations ON reservations_rooms.reservation_id = reservations.id
                WHERE reservations_rooms.room_id = rooms.id
                AND (
                    (reservations.check_in_date BETWEEN '2023-07-13' AND '2023-07-16')
                    OR (reservations.check_out_date BETWEEN '2023-07-13' AND '2023-07-16')
                )
            )
            GROUP BY room_type_id
        */


        $results = DB::table('rooms')
            ->select('room_type_id', DB::raw('COUNT(*) as available_rooms'))
            ->whereNotExists(function ($query) use ($periodOfStay) {
                $query->select(DB::raw(1))
                    ->from('reservations_rooms')
                    ->join('reservations', 'reservations_rooms.reservation_id', '=', 'reservations.id')
                    ->whereRaw('reservations_rooms.room_id = rooms.id')
                    ->where(function ($subQuery) use ($periodOfStay) {
                        $subQuery->whereBetween('reservations.check_in_date', $periodOfStay)
                            ->orWhereBetween('reservations.check_out_date', $periodOfStay);
                    });
            })
            ->groupBy('room_type_id')
            ->get();

        $roomTypes = [];
        foreach ($results as $result) {
            $roomType = RoomType::find($result->room_type_id);
            if ($roomType) {
                $roomType->available_rooms = $result->available_rooms;
                $roomTypes[] = $roomType;
            }
        }

        return view('booking.search', [
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
