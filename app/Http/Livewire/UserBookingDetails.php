<?php

namespace App\Http\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use App\Services\ReservationPaymentService;

class UserBookingDetails extends Component
{
    public Reservation $reservation;

    public $coupon;
    public $couponCode;
    public $subTotal;
    public $totalAmount;
    public $currency;


    protected $reservationPaymentService;
    protected $listeners = ['cancelBooking' => 'cancelBooking'];

    public function boot()
    {
        $this->reservationPaymentService = new ReservationPaymentService();
    }
    public function mount(Reservation $reservation)
    {

        $this->reservation = $reservation->load('rooms.pivot.roomDeal', 'invoice.coupon');
        $this->currency = $reservation->invoice->preferred_currency;
        $this->coupon = $reservation->invoice->coupon;
        $this->couponCode = $this->coupon ? $this->coupon->coupon_code : '';
        $this->calculateSubTotal();
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

    public function calculateSubTotal()
    {
        $this->subTotal = $this->reservationPaymentService->calculateSubTotal($this->reservation->rooms, $this->currency);
    }
    public function getRoomPrice($roomDeal)
    {
        return $this->reservationPaymentService->getRoomPrice($roomDeal, $this->currency);
    }
    public function getUnitProperty(): string
    {
        return $this->currency === "MMK" ? 'Ks.' : '$';
    }
}
