<?php

namespace App\Http\Livewire;

use App\Models\RoomType;
use Livewire\Component;

class RoomsIndex extends Component
{
    public $roomTypes;
    protected $listeners = ['category_selected' => 'sort_by_category'];


    public function mount()
    {
        $this->roomTypes = RoomType::all();
    }

    public function sort_by_category($selectedRoomCategory)
    {
        if (!$selectedRoomCategory == "") {
            $this->roomTypes = RoomType::belongsToCategory($selectedRoomCategory);
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
