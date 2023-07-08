<x-layout>
    <x-nav>
        <a href="/register">
            <button class="nav__button button button--secondary">Join Membership</button>
        </a>
        <span class="nav__span">Get discounts up to 20%</span>
    </x-nav>

    <x-step-bar active="1"></x-step-bar>

    {{-- Booking Form --}}
    <x-booking-form type="filled"></x-booking-form>


    <section class="result-section">
        <header class="result-section__header">
            <h2 class="result-section__title">Select Room</h2>
            <span class="result-section__found-text">Found 1 Rooms</span>
            <div class="result-section__box result-section__box--sort">
                <select class="result-section__select result-section__select--sort" name="sortSelectValue"
                    id="sortSelectValue">
                    <option value="" disabled selected hidden>Sort By</option>
                    <option value="1">Price High to Low </option>
                    <option value="1">Price Low to High</option>
                </select>
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
        <x-room-result></x-room-result>
    </section>
</x-layout>
