<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomCategory;

class CategorySelect extends Component
{
    public $selectedRoomCategory;
    public $roomCategories;

    public function mount()
    {
        $this->roomCategories = RoomCategory::all();
    }


    // public function updatedSelectedRoomCategory($value)
    // {
    //     $this->emit('category_selected', $this->selectedRoomCategory);
    // }

    public function render()
    {
        return view('livewire.category-select');
    }
}
