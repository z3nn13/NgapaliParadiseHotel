<x-layout>
    <x-nav>
        <a href="/register">
            <button class="nav__button button button--special">Join Membership</button>
        </a>
        <span class="nav__span">Get discounts up to 20%</span>
    </x-nav>

    <x-step-bar active="1"></x-step-bar>

    {{-- Booking Form --}}
    <x-booking-form type="search"></x-booking-form>

    <section class="result-section">
        <header class="result-section__header container--search">
            <h2 class="result-section__title">Select Room</h2>
            <span class="result-section__found-text">Found {{ count($roomTypes) }} Rooms</span>

            @php
                $value = isset($sortSelectValue) ? $sortSelectValue : null;
            @endphp
            <x-sort-select :roomTypes=$roomTypes :sortSelectValue=$value></x-sort-select>

            <div class="result-section__box result-section__box--filter">
                <select class="result-section__select result-section__select--filter" name="filterSelectValue"
                    id="filterSelectValue">
                    <option value="" disabled selected hidden>Filter By</option>
                    <option value="1">Bed</option>
                    <option value="1">View</option>
                </select>
            </div>
        </header>
        @foreach ($roomTypes as $roomType)
            <x-room-result :roomType=$roomType></x-room-result>
        @endforeach
    </section>
</x-layout>
