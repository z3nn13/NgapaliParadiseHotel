<x-app-layout>

    <x-nav></x-nav>

    <x-step-bar active="1"></x-step-bar>

    {{-- Booking Form --}}
    <x-booking-form type="search">
        <a href="{{ route('index') }}"class="booking__form__button button button--special">
            Edit
        </a>
    </x-booking-form>


    @yield('room-list')
</x-app-layout>
