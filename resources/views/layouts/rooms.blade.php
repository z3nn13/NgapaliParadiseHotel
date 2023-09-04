<x-app-layout>
    <!-- Navigation Start -->
    <x-nav type="primary"
        active="rooms"></x-nav>

    <!-- Hero Section Start-->
    <section class="hero hero--primary set-bg"
        data-set-bg="{{ asset('images/backgrounds/hero__room.png') }}">
        <div class="hero__content">
            <h2 class="hero__title">Our Bed & Rooms</h2>
            <h2 class="hero__subtitle">
                “Indulge in the perfect coastal escape with our carefully curated selection of beachfront rooms.
                Each of our accommodations is designed to provide you with the ultimate blend of comfort.“
            </h2>
        </div>
    </section>

    @yield('rooms_index')
</x-app-layout>
