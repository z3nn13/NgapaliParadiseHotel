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

            <span class="result-section__found-text">Found {{ count($availableRoomData) }} Rooms</span>

            @livewire('sort-select')
        </header>

        @forelse ($paginatedData as $roomData)
            @php
                $roomType = $roomData['roomType'];
                $availableRoomIds = $roomData['availableRoomIds'];
            @endphp
            <x-room-result :wire:key="'room-type-' . $roomType->id"
                :roomType='$roomType'
                :availableRoomIds='$availableRoomIds' />
        @empty
            <div class="room-result container--search">
                <p class="table__cell--not-found">There are no rooms available for these dates</p>
            </div>
        @endforelse

        <!------- Table Pagination ------->
        @if ($paginatedData->total() > $items_per_page)
            <div class="table__pagination">
                {{ $paginatedData->onEachSide(1)->links('livewire.livewire-pagination-links') }}
            </div>
        @endif
    </section>
</div>
