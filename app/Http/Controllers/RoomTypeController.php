<?php

namespace App\Http\Controllers;


use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use Carbon\Carbon;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of resource
     */
    public function index(Request $request)
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
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

        $checkInDate = $request['checkInDate'];
        $checkOutDate = $request['checkOutDate'];
        $periodOfStay = [$checkInDate, $checkOutDate];

        // Get Room types that aren't reserved.
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

        // $results = [room_type_id: 2, available_rooms: 3]
        // Convert Results To RoomType::class.
        $roomTypes = [];
        foreach ($results as $result) {
            $roomType = RoomType::find($result->room_type_id);
            if ($roomType) {
                $roomType->available_rooms = $result->available_rooms;
                $roomTypes[] = $roomType;
            }
        }
        $checkIn = \Carbon\Carbon::parse($checkInDate);
        $checkOut = \Carbon\Carbon::parse($checkOutDate);
        $numNights = $checkIn->diffInDays($checkOut);


        $request->session()->put($request->query());
        $request->session()->put('numNights', $numNights);
        return view('room-types.search', [
            'roomTypes' => $roomTypes
        ]);
    }

    /**
     * Sort room types
     */
    public function sort(Request $request)
    {
        $sortBy = $request->sortSelectValue;
        $roomTypesArray = json_decode($request->roomTypes);
        $roomTypes = collect($roomTypesArray)->map(function ($item) {
            return new RoomType((array) $item);
        });
        if ($sortBy === 'desc') {
            $sortedRoomTypes = $roomTypes->sortByDesc(function ($roomType) {
                return $roomType->highest_price();
            });
        } else {
            $sortedRoomTypes = $roomTypes->sortBy(function ($roomType) {
                return $roomType->lowest_price();
            });
        }

        return view('room-types.search', [
            'roomTypes' => $sortedRoomTypes,
            'sortSelectValue' => $sortBy
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
