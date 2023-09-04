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
    protected $listeners = ['userUpdated' => 'render'];
    protected $queryString = [
        'searchQuery' => ['except' => '', 'as' => "search"],
    ];

    /**
     * Renders the livewire component
     *
     * @return void
     */
    public function render()
    {
        $reservations = $this->getReservations(auth()->user());

        return view('livewire.user-dashboard', compact('reservations'))
            ->layout('layouts.app');
    }

    /**
     * Gets the list of reservations belonging to the specified user
     * 
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return Collection
     */
    private function getReservations($user)
    {
        return $user->reservations()
            ->when($this->searchQuery, fn ($query) => $query
                ->searchBy(trim($this->searchQuery)))
            ->latest()
            ->paginate($this->items_per_page);
    }
}
