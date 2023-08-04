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

    protected $listeners = ['deleteBooking' => 'deleteBooking', 'bookingUpdated' => 'render'];

    public function deleteBooking($bookingId)
    {
        $booking = Reservation::find($bookingId);
        if (!$booking) {
            return;
        }

        $booking->delete();
        $this->emit('dataChanged', 'Booking', $bookingId, 'deleted');
    }

    public function render()
    {
        $trimmedSearchQuery = ltrim($this->searchQuery, ' ');
        if ($trimmedSearchQuery !== "") {
            $bookings = Reservation::searchBy($trimmedSearchQuery)->orderBy($this->sortField, $this->sortDirection)->paginate(6);
        } else {
            $bookings = Reservation::orderBy($this->sortField, $this->sortDirection)->paginate(6);
        }
        $reports =  [
            "totalRevenueToday" => Invoice::totalRevenueToday(),
            "totalReservationsToday" => Reservation::totalReservationsToday(),
        ];

        return view('livewire.admin-dashboard', compact('bookings', 'reports'))
            ->layout('layouts.admin', ['active' => "Dashboard"]);
    }
}
