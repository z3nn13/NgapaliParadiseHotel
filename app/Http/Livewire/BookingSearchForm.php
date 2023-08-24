<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\ReservationService;

class BookingSearchForm extends Component
{
    public $pageType = 'landing';
    public $inputsDisabled = false;

    public $checkInDate;
    public $checkOutDate;
    public $numGuests;


    protected $rules = [
        'checkInDate' => 'required|date|after_or_equal:today',
        'checkOutDate' => 'required|date|after:checkInDate',
        'numGuests' => 'required|integer|min:1|max:10',
    ];

    public function mount($pageType, $checkInDate = null, $checkOutDate = null, $numGuests = null)
    {
        $this->inputsDisabled = $pageType == 'search';
        $this->checkInDate = $checkInDate ?? session('booking.checkInDate', now()->toDateString());
        $this->checkOutDate = $checkOutDate ?? session('booking.checkOutDate', now()->addDay()->toDateString());
        $this->numGuests = $numGuests ?? session('booking.numGuests', 1);
    }

    public function render()
    {
        return view('livewire.booking-search-form');
    }


    public function updated($propertyName)
    {
        $checkIn = Carbon::parse($this->checkInDate);
        $checkOut = Carbon::parse($this->checkOutDate);

        if ($checkOut->lte($checkIn)) {
            $this->checkOutDate = $checkIn->copy()->addDay()->toDateString();
        }
        $this->validateOnly($propertyName);
    }


    public function submit(ReservationService $reservationService)
    {
        if ($this->checkIfDatesExceedsLimit()) {
            return;
        };

        $this->validate();
        $reservationService->initializeSessionData($this->checkInDate, $this->checkOutDate, $this->numGuests);
        $this->redirect(route('booking.search'));
    }

    public function checkIfDatesExceedsLimit()
    {
        $daysLimit = 14;

        $checkIn = Carbon::parse($this->checkInDate);
        $checkOut = Carbon::parse($this->checkOutDate);

        // Checking if it doesn't exceed, this will return early.
        if ($checkOut->diffInDays($checkIn) < $daysLimit) {
            return false;
        }

        // Checking if it exceeds, this will send modal and return.
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'info',
            'title' => 'Notice',
            'html' => 'For stays longer than two weeks, please contact our reception directly for further discussion.<br>Thank you. ',
        ]);
        return true;
    }
}
