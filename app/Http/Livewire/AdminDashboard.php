<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class AdminDashboard extends Component
{
    use WithPagination;
    use WithSorting;

    public $sortField = "id";
    public $searchQuery = ""; // Default search query

    protected $listeners = ['deleteBooking' => 'deleteBooking'];

    public function deleteBooking($bookingId)
    {
        $booking = Reservation::find($bookingId);
        if (!$booking) {
            return;
        }

        $booking->delete();
        $this->emit('bookingDeleted', $bookingId);
    }

    public function render()
    {
        if ($this->searchQuery) {
            $bookings = Reservation::searchByName($this->searchQuery)->orderBy($this->sortField, $this->sortDirection)->paginate(6);
        } else {
            $bookings = Reservation::orderBy($this->sortField, $this->sortDirection)->paginate(6);
        }
        return view(
            'livewire.admin-dashboard',
            [
                'bookings' => $bookings,
                'reports' => [
                    "totalRevenueToday" => Invoice::totalRevenueToday(),
                    "totalReservationsToday" => Reservation::totalReservationsToday(),
                ],
            ]
        )
            ->layout('layouts.admin', ['active' => "Dashboard"]);
    }
}
