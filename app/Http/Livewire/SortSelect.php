<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RoomType;

class SortSelect extends Component
{
    public $selectedSortOption;

    public function option_selected()
    {
        $this->emit('option_selected', $this->selectedSortOption);
    }

    public function render()
    {
        return view('livewire.sort-select');
    }
}
