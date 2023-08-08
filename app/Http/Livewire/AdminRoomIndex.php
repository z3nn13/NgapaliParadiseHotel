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

        $roomTypes = RoomType::when($this->searchQuery, function ($query) {
            return $query->searchBy(trim($this->searchQuery));
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(6);

        $this->paginatedModels = $roomTypes->items();

        return view('livewire.admin-room-index', compact('roomTypes'))
            ->layout('layouts.admin', ['active' => 'Rooms']);
    }

    public function deleteRoomTypes(array $roomTypeIds)
    {
        $this->bulkDelete(RoomType::class, $roomTypeIds);
    }

    public function exportClickListener()
    {
        return $this->bulkExport(RoomTypesExport::class, 'RoomTypes.xlsx',);
    }
}
