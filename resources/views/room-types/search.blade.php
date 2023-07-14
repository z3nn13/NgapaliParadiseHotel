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
            <div class="result-section__box result-section__box--sort">
                {{-- <select class="result-section__select result-section__select--sort" name="sortSelect" id="sortSelect"
                    data-room-types="{{ json_encode($roomTypes) }}"> --}}
                <form action="{{ route('room-types.sort') }}" method="POST">
                    @csrf
                    <input type="hidden" name="roomTypes" value="{{ json_encode($roomTypes) }}">
                    <select onchange="this.form.submit()" class="result-section__select result-section__select--sort"
                        name="sortSelectValue" id="sortSelectValue">
                        <option value="" disabled selected hidden>Sort By</option>
                        <option value="asc" @if ($sortSelectValue == 'asc') selected @endif>
                            Price: High to Low
                        </option>
                        <option value="desc" @if ($sortSeectValue == 'desc') selected @endif>
                            Price: Low to High</option>
                    </select>
                </form>
            </div>
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
