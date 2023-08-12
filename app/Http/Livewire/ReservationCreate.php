<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use App\Models\RoomDeal;
use App\Services\ReservationPaymentService;

class ReservationCreate extends Component
{
    public $couponCode = "";
    public $coupon = null;

    public $preferredCurrency = "MMK";
    public $unit;
    public $subTotal;
    public $totalAmount;

    protected $rules = [
        'couponCode' => 'nullable|string|max:255',
    ];

    protected ReservationPaymentService $reservationPaymentService;

    public function boot(ReservationPaymentService $reservationPaymentService)
    {
        $this->reservationPaymentService = $reservationPaymentService;
    }

    public function render()
    {
        $this->unit = $this->preferredCurrency === "MMK" ? "Ks." : "$";

        $reservationRooms = session('reservation_rooms');
        $this->calculateSubTotal($reservationRooms);
        $this->calculateTotal($this->subTotal);

        return view('livewire.reservation-create', compact('reservationRooms'))->layout('layouts.app');
    }



    public function updatedCouponCode()
    {
        $this->validateOnly('couponCode');
        $this->retrieveCoupon($this->reservationPaymentService);
    }

    private function retrieveCoupon(ReservationPaymentService $reservationPaymentService)
    {
        $couponCode = strtoupper(trim($this->couponCode));
        if (!$couponCode) {
            return null;
        }

        $coupon = $reservationPaymentService->retrieveCoupon($this->couponCode);

        if ($coupon === null) {
            $this->addError('couponCode', 'Invalid coupon code.');
        }
        $this->coupon = $coupon;
    }

    private function calculateTotal($subTotal)
    {
        $this->totalAmount = $this->reservationPaymentService->applyCoupon(
            $subTotal,
            $this->coupon,
            $this->preferredCurrency
        );
    }

    private function calculateSubTotal($reservationRooms)
    {
        $this->subTotal = $this->reservationPaymentService->calculateSubTotal($reservationRooms, $this->preferredCurrency);
    }

    public function getRoomPrice(RoomDeal $roomDeal)
    {
        return $this->reservationPaymentService->getRoomPrice($roomDeal, $this->preferredCurrency);
    }
}
