<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\RoomType;

class AdminRoomIndex extends Component
{

    use WithPagination;
    use WithSorting;

    public $sortField = "id";
    public $searchQuery = '';

    public function render()
    {

        return view(
            'livewire.admin-room-index',
            [
                'rooms' => RoomType::paginate(6),
            ]
        )
            ->layout('layouts.admin', ['active' => "Rooms"]);
    }
}
