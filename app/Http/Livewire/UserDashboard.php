<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Reservation;
use Livewire\Component;
use Livewire\WithPagination;

class UserDashboard extends Component
{
    use WithPagination;

    public $searchQuery = "";
    public $items_per_page = "6";

    protected $queryString = [
        'searchQuery' => ['except' => '', 'as' => "search"],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $reservations = $this->getReservations(auth()->user());

        return view('livewire.user-dashboard', compact('reservations'))
            ->layout('layouts.app');
    }


    private function getReservations($user)
    {
        return $user->reservations()
            ->when($this->searchQuery, fn ($query) => $query
                ->searchBy(trim($this->searchQuery)))
            ->latest()
            ->paginate($this->items_per_page);
    }
}
