<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomType;

class SortSelect extends Component
{
    public $roomTypes;

    public function mount($roomTypes)
    {
        $this->roomTypes = $roomTypes;
    }

    public function sortRoomTypes($sortOption)
    {
        $roomTypes = collect($this->roomTypes)->map(function ($data) {
            return new RoomType($data);
        });
        if ($sortOption === 'desc') {
            $sortedRoomTypes = $roomTypes->sortByDesc(function ($roomType) {
                return $roomType->highest_price();
            });
        } else {
            $sortedRoomTypes = $roomTypes->sortBy(function ($roomType) {
                return $roomType->lowest_price();
            });
        }
        $this->emit('roomTypesSorted', $sortedRoomTypes);
    }

    public function render()
    {
        return view('livewire.sort-select');
    }
}
