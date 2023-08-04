<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomType;
use Livewire\WithPagination;
use App\Exports\RoomTypesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Livewire\Traits\WithSorting;
use \Illuminate\Support\Collection;

class AdminRoomIndex extends Component
{

    use WithPagination;
    use WithSorting;

    public Collection $selectedRoomTypes;
    public $selectAll = false;

    public $sortField = "id";
    public $searchQuery = "";
    public $paginatedRoomTypes;

    protected $listeners = ['deleteRoomType' => 'deleteRoomType', 'roomUpdated' => 'render'];

    public function mount()
    {
        $this->selectedRoomTypes = new Collection();
    }

    /*
    *
    * Render the Livewire component.
    *
    */
    public function render()
    {
        $roomTypes = RoomType::when($this->searchQuery, function ($query) {
            return $query->searchBy(trim($this->searchQuery));
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(6);

        return view('livewire.admin-room-index', compact('roomTypes'))
            ->layout('layouts.admin', ['active' => 'Rooms']);
    }

    /*
    *
    * Delete a specific room type.
    *
    */
    public function deleteRoomType($roomTypeId)
    {
        RoomType::findOrFail($roomTypeId)->delete();
        $this->emit('dataChanged', 'Room Type', $roomTypeId, 'deleted');
    }

    /*
    *
    * Handle the "select all" checkbox toggle event.
    *
    */
    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedRoomTypes = collect(array_map(function ($roomType) {
                return $roomType['id'];
            }, $this->paginatedRoomTypes));
        } else {
            $this->selectedRoomTypes = new Collection();
        }
        dd($this->selectedRoomTypes);
    }

    /*
    *
    * Get the IDs of the selected room types.
    *
    */
    public function getSelectedRoomTypes()
    {
        return $this->selectedRoomTypes->filter(fn ($p) => $p)->keys();
    }

    /*
    *
    * Export selected room types to an Excel file.
    *
    */
    public function export()
    {
        return Excel::download(new RoomTypesExport($this->getSelectedRoomTypes()), 'RoomTypes.xlsx');
    }
}
