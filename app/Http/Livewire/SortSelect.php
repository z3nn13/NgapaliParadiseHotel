<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomType;

class SortSelect extends Component
{
    public $selectedSortOption;

    public function render()
    {
        return view('livewire.sort-select');
    }

    public function optionSelected()
    {
        $this->emit('optionSelected', $this->selectedSortOption);
    }
}
