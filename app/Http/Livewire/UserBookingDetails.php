<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use App\Services\ReservationPaymentService;

class UserBookingDetails extends Component
{
    public $reservation;
    public $subTotal;
    public $totalAmount;
    public $coupon;

    protected $listeners = ['cancelBooking' => 'cancelBooking'];

    public function mount(Reservation $reservation, ReservationPaymentService $reservationPaymentService)
    {
        $this->reservation = $reservation;
    }

    public function confirmCancel()
    {
        $this->dispatchBrowserEvent('swal:confirm_cancel', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            "text" => "You won't be able to revert this!",
        ]);
    }

    public function cancelBooking(): void
    {
        $this->reservation->status = 'Cancelling';
        $this->reservation->save();
        $this->dispatchBrowserEvent('swal:notification', [
            'type' => 'success',
            'text' => 'Your request has been submitted. We will contact you shortly.'
        ]);
    }

    public function render()
    {
        return view('livewire.user-booking-details')
            ->layout('layouts.app');
    }
}
