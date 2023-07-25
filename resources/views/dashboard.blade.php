<x-app-layout>
    <x-nav type="primary"></x-nav>

    <!-- Hero Section Start-->
    <section class="hero hero--primary set-bg"
        data-set-bg="{{ asset('images/backgrounds/hero__gallery.png') }}">
        <div class="hero__content">
            <h2 class="hero__title">Welcome Back, {{ auth()->user()->first_name }}</h2>
        </div>
    </section>
    <h1>Booking History</h1>
    @forelse (auth()->user()->reservations as $reservation)
    @empty
        No Reservations Found
    @endforelse

</x-app-layout>
