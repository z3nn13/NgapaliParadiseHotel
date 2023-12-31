<x-app-layout>
    <x-nav type="landing"></x-nav>

    {{-- Hero Section --}}
    <section class="hero hero--landing">
        <div class="hero__content">
            <div class="hero__content--wrapper">
                <h2 class="hero__title">Come Experience</h2>
                <h2 class="hero__subtitle">
                    Coastal<br>
                    Luxury At<br>
                    Its Finest<br>
                    & Exquisite</h2>
                <span class="hero__span">Plan your dream vacation by the beach.</span>
            </div>
        </div>
        <div class="hero__image-wrapper">
            <img class="hero__image"
                src="/images/home/hero_bg.png"
                alt="image of a house">
        </div>
    </section>

    {{-- Booking Form --}}
    @livewire('booking-search-form', ['pageType' => 'landing'])


    {{-- Wave Section --}}
    <section class="wave-section">
        <div class="wave-section__left">
            <h2>Discover the perfect
                blend of warmth, and coastal charm.</h2>
        </div>
        <div class="wave-section__right">
            <p class="wave-section__paragraph">
                Nestled along the <span class="wave-section__text--bold">serene shores of Ngapali Beach</span>, we
                offer exquisite accommodations, with delectable culinary delights, and a mesmerizing allure of our
                breathtaking vistas.
            </p>
        </div>
        {{-- <img class="wave-section__image" src="/images/home/waves.png" alt="image of waves"> --}}
    </section>


    {{-- Pool Section --}}
    <section class="pool-section">
        <img class="pool-section__image"
            src="/images/home/pool.png"
            alt="image of a pool">
        <div class="pool-section__content">
            <p class="pool-section__paragraph">
                Unwind upon the allure of our beachside hotel, where
                pristine beaches beckon and a sparkling pool
                awaits, offering a blissful oasis for your
                unforgettable escape.
            </p>
            <a class="pool-section__button button button--primary"
                href="/about">
                <span class="button__body">Our Story</span>
                <span class="button__append"><i class="fa-solid fa-arrow-right"></i></span>
            </a>
        </div>
    </section>

    {{-- Room Section --}}
    <section class="room-section">
        <div class="room-section__content">

            <h2 class="room-section__heading">Award-Winning</h2>
            <h3 class="room-section__title">Seafront Rooms</h3>
            <p class="room-section__paragraph">Experience pure bliss in our seaside rooms perfectly positioned along
                the
                shore, offering breathtaking panoramic views of the sparkling ocean right from your window.</p>
            <a class="room-section__button--primary button button--primary"
                href="/rooms">
                Discover Room
            </a>
            <a class="room-section__button--secondary button button--secondary"
                href="/register">
                Join Membership
            </a>
        </div>

        <div class="room-section__image-layout">
            <img class="room-section__image room-section__image--left"
                src="/images/home/room_1.png">
            <img class="room-section__image room-section__image--top-right"
                src="/images/home/room_2.png">
            <img class="room-section__image room-section__image--bottom-right"
                src="/images/home/room_3.png">
        </div>
    </section>
</x-app-layout>
