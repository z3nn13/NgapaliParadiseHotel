<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $checkInDate = $request['arrivalDate'];
        $checkOutDate = $request['departureDate'];
        $periodOfStay = [$checkInDate, $checkOutDate];

        $roomTypes = RoomType::all();
        // sql = """SELECT RoomTypeID, COUNT(*)
        // FROM room
        // WHERE NOT EXISTS (
        //     -- room is booked on the requested dates (...not)
        //     SELECT 1
        //     FROM reservedRoom
        //     JOIN bookings ON reservedRoom.bookingID = bookings.bookingID
        //     WHERE reservedRoom.roomID = room.roomID
        //     AND '2018-02-09' > checkIndate
        //     AND '2018-02-08' < checkOutDate
        // )
        // GROUP BY RoomTypeID}

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
    public function store(StoreRoomTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        //
    }
}
