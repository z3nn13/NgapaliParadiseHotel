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
    protected $listeners = ['deleteReservations' => 'deleteReservations', 'bookingUpdated' => 'render'];

    public function mount()
    {
        $this->reports =  [
            "totalRevenueToday" => Invoice::totalRevenueToday(),
            "totalReservationsToday" => Reservation::totalReservationsToday(),
        ];
    }

    public function render()
    {
        $reservations = Reservation::when($this->searchQuery, function ($query) {
            return $query->searchBy(trim($this->searchQuery));
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(6);

        $this->paginatedModels = $reservations->items();

        return view('livewire.admin-dashboard', compact('reservations'))
            ->layout('layouts.admin', ['active' => "Dashboard"]);
    }

    public function deleteReservations(array $reservationIds)
    {
        $this->bulkDelete(Reservation::class, $reservationIds);
    }


    public function exportClickListener()
    {
        return $this->bulkExport(ReservationExport::class, 'Reservations.xlsx');
    }
}
