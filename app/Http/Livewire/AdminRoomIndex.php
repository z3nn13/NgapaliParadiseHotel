<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomType;
use Livewire\WithPagination;
use App\Exports\RoomTypesExport;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithSorting;

class AdminRoomIndex extends Component
{

    use WithPagination;
    use WithSorting;
    use WithBulkActions;

    protected $listeners = ['deleteRoomTypes' => 'deleteRoomTypes', 'roomUpdated' => 'render'];

    public function render()
    {
        $roomTypes = $this->loadPageItems(RoomType::class, 6);

        return view('livewire.admin-room-index', compact('roomTypes'))
            ->layout('layouts.admin', ['active' => 'Rooms']);
    }

    public function deleteRoomTypes(array $roomTypeIds)
    {
        $this->bulkDelete(RoomType::class, $roomTypeIds);
    }

    public function exportRoomTypes()
    {
        return $this->bulkExport(RoomTypesExport::class, 'RoomTypes.xlsx',);
    }
}
