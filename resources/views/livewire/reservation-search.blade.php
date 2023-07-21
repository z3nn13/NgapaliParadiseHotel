<section class="result-section">
    <header class="result-section__header container--search">
        <h2 class="result-section__title">Select Room</h2>
        <span class="result-section__found-text">Found {{ count($availableRoomTypes) }} Rooms</span>

        <livewire:sort-select :roomTypes="$availableRoomTypes" />
        <div class="result-section__box result-section__box--filter">
            <select class="result-section__select result-section__select--filter" name="filterSelectValue"
                id="filterSelectValue">
                <option value="" disabled selected hidden>Filter By</option>
                <option value="1">Bed</option>
                <option value="1">View</option>
            </select>
        </div>
    </header>

    @foreach ($availableRoomTypes as $roomType)
        <x-room-result :wire:key="'room-type-'.$roomType->id" :roomType=$roomType></x-room-result>
    @endforeach
</section>
