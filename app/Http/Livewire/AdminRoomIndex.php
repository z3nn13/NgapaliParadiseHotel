<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\RoomType;

use function Termwind\render;

class AdminRoomIndex extends Component
{

    use WithPagination;
    use WithSorting;

    public $sortField = "id";
    public $searchQuery = ""; // Default search query

    protected $listeners = ['deleteRoomType' => 'deleteRoomType', 'roomUpdated' => 'render'];

    public function deleteRoomType($roomTypeId)
    {
        $roomType = RoomType::find($roomTypeId);
        if (!$roomType) {
            return;
        }

        $roomType->delete();
        $this->emit('dataChanged', 'Room Type', $roomTypeId, 'deleted');
    }

    public function render()
    {
        $trimmedSearchQuery = trim($this->searchQuery);
        if ($trimmedSearchQuery !== "") {
            $roomTypes = RoomType::searchBy($trimmedSearchQuery)->orderBy($this->sortField, $this->sortDirection)->paginate(6);
        } else {
            $roomTypes = RoomType::orderBy($this->sortField, $this->sortDirection)->paginate(6);
        }

        return view('livewire.admin-room-index', compact('roomTypes'))
            ->layout('layouts.admin', ['active' => "Rooms"]);
    }
}
