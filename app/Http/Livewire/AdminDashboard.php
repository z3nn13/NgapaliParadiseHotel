<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Exports\ReservationsExport;
use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithBulkActions;

class AdminDashboard extends Component
{
    use WithPagination;
    use WithSorting;
    use WithBulkActions;

    public $reports;

    protected $listeners = ['deleteReservations' => 'deleteReservations', 'reservationUpdated' => 'render'];
    protected $queryString = [
        'searchQuery' => ['except' => '', 'as' => 'search'],
    ];
    public function render()
    {
        $reservations = $this->loadPageItems(Reservation::class);

        return view('livewire.admin-dashboard', compact('reservations'))
            ->layout('layouts.admin', ['active' => "Dashboard"]);
    }

    public function deleteReservations(array $reservationIds)
    {
        $this->bulkDelete(Reservation::class, $reservationIds);
    }


    public function exportReservations(string $filetype)
    {
        return $this->bulkExport(ReservationsExport::class, 'Reservations', $filetype);
    }
}
