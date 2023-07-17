<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;

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
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');

        $availableRoomTypes = Room::availableRoomTypes($checkInDate, $checkOutDate)->get();

        $roomTypeIds = $availableRoomTypes->pluck('room_type_id')->toArray();

        $roomTypes = RoomType::whereIn('id', $roomTypeIds)
            ->get()
            ->keyBy('id')
            ->map(function ($roomType) use ($availableRoomTypes) {
                $result = $availableRoomTypes->firstWhere('room_type_id', $roomType->id);
                $roomType->available_rooms = $result->available_rooms;
                return $roomType;
            });

        $numNights = Carbon::parse($checkInDate)
            ->diffInDays(Carbon::parse($checkOutDate));

        $request->session()->put($request->query());
        $request->session()->put('numNights', $numNights);

        return view('room-types.search', compact('roomTypes'));
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

        return view('livewire.room-type-search', [
            'roomTypes' => $sortedRoomTypes,
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
