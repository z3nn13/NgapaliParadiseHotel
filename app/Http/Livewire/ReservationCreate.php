<?php

namespace App\Http\Livewire;

use App\Models\Room;
use Livewire\Component;
use App\Models\RoomDeal;
use App\Services\ReservationService;
use App\Services\ReservationPaymentService;

class ReservationCreate extends Component
{
    public $couponCode = "";
    public $coupon;

    public $preferredCurrency;
    public $subTotal;
    public $totalAmount;

    public $reservationRooms;

    protected ReservationPaymentService $reservationPaymentService;
    protected $rules = [
        'couponCode' => 'nullable|string|max:255',
    ];
    protected $listeners = [
        'updatedPreferredCurrency' => 'changeCurrency',
        'formSubmitted' => 'completeStage',
        'destroyReservationRoom' => 'destroyReservationRoom'
    ];


    public function boot(ReservationPaymentService $reservationPaymentService)
    {
        $this->reservationPaymentService = $reservationPaymentService;
    }

    public function mount()
    {
        // Auto-fill Data
        $this->preferredCurrency = session('booking.billingData.preferredCurrency', "MMK");
        $this->coupon = session('booking.billingData.coupon');
        $this->couponCode = optional($this->coupon)->coupon_code;
    }

    public function hydrate()
    {
        foreach ($this->reservationRooms as &$reservationRoom) {
            $reservationRoom['room'] = Room::with('roomType')->find($reservationRoom['room']['id']);
            $reservationRoom['roomDeal'] = RoomDeal::make($reservationRoom['roomDeal']);
        }
    }

    public function render()
    {
        $this->reservationRooms = session('booking.reservation_rooms', []);
        $this->calculateSubTotal($this->reservationRooms);
        $this->calculateTotal($this->subTotal);

        return view('livewire.reservation-create')->layout('layouts.app');
    }

    public function confirmDeleteRoom($roomJson)
    {
        $this->dispatchBrowserEvent(
            "swal:confirm_delete_room",
            [
                "type" => "warning",
                'title' => 'Are you sure?',
                "text" => "You won't be able to revert this!",
                'room' => $roomJson,
            ]
        );
    }

    public function destroyReservationRoom(Room $room, ReservationService $reservationService)
    {
        if (count($this->reservationRooms) > 1) {
            $reservationService->destroyRoomFromSession($room);
            $this->dispatchBrowserEvent('swal:notification', [
                'type' => 'success',
                'text' => 'Successfully removed an item from this reservation.',
            ]);
        } else {
            session()->forget('booking.reservation_rooms');
            return redirect()->route('booking.search');
        }
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

    public function getUnitProperty()
    {
        return $this->preferredCurrency === "MMK" ? "Ks." : "$";
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
