<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchPage extends Component
{
    public $roomTypes;

    protected $listeners = ['roomTypesSorted' => 'updateRoomTypes'];

    public function updateRoomTypes($updatedRoomTypes)
    {
        $this->roomTypes = $updatedRoomTypes;
    }

    public function render()
    {
        return view('livewire.search-page');
    }
}
