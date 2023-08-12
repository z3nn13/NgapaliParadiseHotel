<?php

namespace App\Http\Livewire;

use App\Models\RoomType;
use Livewire\Component;

class RoomsIndex extends Component
{
    public $roomTypes;
    protected $listeners = ['categorySelected' => 'sortByCategory'];


    public function mount()
    {
        $this->roomTypes = RoomType::all();
    }

    public function sortByCategory($selectedRoomCategoryID)
    {
        if (!empty($selectedRoomCategoryID)) {
            $this->roomTypes = RoomType::belongsToCategory($selectedRoomCategoryID);
        } else {
            $this->roomTypes = RoomType::all();
        }
    }
    public function render()
    {
        return view('livewire.rooms-index')
            ->extends('layouts.rooms')
            ->section('rooms_index');
    }
}
