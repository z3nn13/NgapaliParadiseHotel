<div>
    <x-nav></x-nav>

    <x-step-bar active="1"></x-step-bar>

    {{-- Booking Form --}}
    @livewire('booking-search-form', [
        'pageType' => 'search',
        'checkInDate' => $checkInDate,
        'checkOutDate' => $checkOutDate,
        'numGuests' => $numGuests,
    ])

    <section class="result-section">
        <header class="result-section__header container--search">
            <h2 class="result-section__title">Select Room</h2>
            <span class="result-section__found-text">Found {{ count($this->availableRoomTypes) }} Rooms</span>

            @livewire('sort-select')

            {{-- <div class="result-section__box result-section__box--filter">
                <select class="result-section__select result-section__select--filter" id="filterSelectValue" name="filterSelectValue">
                    <option value="" disabled selected hidden>Filter By</option>
                    <option value="1">Bed</option>
                    <option value="1">View</option>
                </select>
            </div> --}}
        </header>

        @forelse ($this->availableRoomTypes as $roomType)
            <x-room-result :wire:key="'room-type-'.$roomType->id"
                :roomType='$roomType'></x-room-result>
        @empty
            <p>No rooms available for these dates</p>
        @endforelse
    </section>

</div>
