<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use App\Models\RoomDeal;
use App\Services\ReservationPaymentService;

class ReservationCreate extends Component
{
    public $couponCode = "";
    public $coupon;

    public $preferredCurrency = "MMK";
    public $unit;
    public $subTotal;
    public $totalAmount;

    protected ReservationPaymentService $reservationPaymentService;
    protected $rules = [
        'couponCode' => 'nullable|string|max:255',
    ];
    protected $listeners = ['updatedPreferredCurrency' => 'changeCurrency', 'formSubmitted' => 'completeStage'];


    public function boot(ReservationPaymentService $reservationPaymentService)
    {
        $this->reservationPaymentService = $reservationPaymentService;
    }

    public function mount()
    {
        $this->preferredCurrency = session('booking.billingData.preferredCurrency');
        $this->coupon = session('booking.billingData.coupon');
        $this->couponCode = $this->coupon->coupon_code;
    }

    public function render()
    {
        $this->unit = $this->preferredCurrency === "MMK" ? "Ks." : "$";

        $reservationRooms = session('booking.reservation_rooms');
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

    public function changeCurrency($preferredCurrency)
    {
        $this->preferredCurrency = $preferredCurrency;
    }

    public function completeStage($billingData)
    {
        $additionalData = [
            'coupon' => $this->coupon,
            'subTotal' => $this->subTotal,
            'totalAmount' => $this->totalAmount,
        ];
        $billingData = array_merge($billingData, $additionalData);

        session(['booking.billingData' => $billingData]);
        session(['booking.create' => true]);
        return redirect()->route('booking.confirm');
    }
}
