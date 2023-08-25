<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class AdminDashboard extends Component
{
    use WithPagination;
    use WithSorting;
    use WithBulkActions;

    public $reports;

    protected $listeners = ['deleteReservations' => 'deleteReservations', 'reservationUpdated' => 'render'];

    public function render()
    {
        $reservations = $this->loadPageItems(Reservation::class, 6);

        return view('livewire.admin-dashboard', compact('reservations'))
            ->layout('layouts.admin', ['active' => "Dashboard"]);
    }

    public function deleteReservations(array $reservationIds)
    {
        $this->bulkDelete(Reservation::class, $reservationIds);
    }


    public function exportReservations()
    {
        return $this->bulkExport(ReservationExport::class, 'Reservations.xlsx');
    }
}
