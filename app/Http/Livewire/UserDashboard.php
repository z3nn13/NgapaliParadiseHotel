<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use Livewire\WithPagination;

class UserDashboard extends Component
{
    use WithPagination;

    public $searchQuery = "";
    public $items_per_page = "6";

    public function render()
    {
        $user = auth()->user();

        $reservations = $user->reservations()
            ->when($this->searchQuery, fn ($query) => $query
                ->searchBy(trim($this->searchQuery)))
            ->orderByDesc('created_at')
            ->paginate($this->items_per_page);

        return view(
            'livewire.user-dashboard',
            compact('reservations')
        )
            ->layout('layouts.app');
    }
}
