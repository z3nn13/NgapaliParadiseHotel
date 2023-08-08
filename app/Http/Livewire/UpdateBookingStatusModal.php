<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use LivewireUI\Modal\ModalComponent;

class UpdateBookingStatusModal extends ModalComponent
{
    public Reservation $reservation;
    public $status;

    public function mount(Reservation $reservation)
    {
        $this->reservation->$reservation;
        $this->status = $reservation->status;
    }

    public function render()
    {
        return view('livewire.update-booking-status-modal');
    }

    public function saveBookingStatus()
    {
        $this->reservation->status = $this->status;
        $this->reservation->save();

        $this->closeModalWithEvents([
            AdminDashboard::getName() => 'reservationUpdated'
        ]);
        $message = 'Booking ID #' . sprintf('%04d', $this->reservation->id) . 'has been saved successfully';
        $this->emit('dataChanged', 'Save Successful!', $message);
    }
}
