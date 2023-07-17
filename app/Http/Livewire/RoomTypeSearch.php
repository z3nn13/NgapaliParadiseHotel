<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomTypeSearch extends Component
{
    public $availableRoomTypes;
    public $availableRooms;


    public function mount(Request $request)
    {
        $checkInDate = $request->input('checkInDate');
        $checkOutDate = $request->input('checkOutDate');

        $numNights = Carbon::parse($checkInDate)->diffInDays(Carbon::parse($checkOutDate));
        $request->session()->put($request->query());
        $request->session()->put('numNights', $numNights);

        $availableRooms = Room::availableRooms($checkInDate, $checkOutDate)->get();
        $this->availableRooms = $availableRooms;
        $this->availableRoomTypes = $availableRooms->pluck('room_type');
    }

    public function render()
    {
        $availableRoomTypes = $this->availableRoomTypes;
        $availableRooms = $this->availableRooms;
        return view('livewire.room-type-search', compact('availableRoomTypes', 'availableRooms'));
    }
}
