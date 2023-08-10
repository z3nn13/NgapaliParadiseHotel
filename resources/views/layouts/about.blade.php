<x-app-layout>
    <x-nav></x-nav>

    <!-- Hero Section Start -->
    <section class="hero hero--primary set-bg"
        data-set-bg="{{ asset('images/backgrounds/hero__about.png') }}">
        <div class="hero__content">
            <h2 class="hero__title">About Us</h2>
            <h2 class="hero__subtitle">
                ““Welcome to Ngapali Paradise Hotel <br>- Where Every Wave Tells a Story““
            </h2>
        </div>
    </section>

    <section class="about-section container__about">
        <div class="about-section__item about-section__item--vertical">
            <div class="about-content">
                <h2 class="about-content__title about-content__title--large">
                    Our Story
                </h2>
                <p class="about-content__text about-content__text--large">
                    In 2018, we embarked on a journey to create a haven, Ngapali Paradise Hotel, nestled by Ngapali Beach in Thandwe, Myanmar. Our commitment was to offer travelers a retreat with sea
                    or
                    beachfront views, each room telling its own tale. Over time, our collaborations with local tour services blossomed, weaving deeper experiences into the fabric of our narrative.
                    Today,
                    as the sun kisses the waves, we stand proud, a haven where stories unfold, and memories are etched in the sands of time.
                </p>
            </div>
        </div>

        <div class="about-section__item">
            <div class="about-content">
                <h2 class="about-content__title">
                    Sustaining elegance.
                </h2>
                <p class="about-content__text">
                    Ngapali Paradise Hotel effortlessly blends eco-consciousness. Our sea/beachfront rooms exemplify sustainable elegance. With responsible sourcing, local collaborations, and
                    eco-practices, we curate a stay that embodies sophistication with a positive environmental impact.
                </p>
            </div>
            <img class="about-content__image"
                src="{{ asset('images/about/about-1.png') }}"
                alt="">
        </div>

        <div class="about-section__item">
            <img class="about-content__image"
                src="{{ asset('images/about/about-2.png') }}"
                alt="">

            <div class="about-content">
                <h2 class="about-content__title">
                    Fostering community growth.
                </h2>
                <p class="about-content__text">
                    Ngapali Paradise Hotel fosters connections in Thandwe. Engage with local tours, borrow amenities, and relish discounts. Together, we're nurturing community development and cultural
                    experiences.
                </p>
            </div>
        </div>
    </section>

    <section class="service-section">
        <div class="service-section__container">
            <div class="service-section__item">
                <img class="service-content__img"
                    src="{{ asset('images/about/service-1.png') }}"
                    alt="">
                <div class="service-content">
                    <h2 class="service-content__title">Rental Services</h2>
                    <p class="service-content__text">Whether you're looking for beach equipment, bikes to explore the coastal trails, or even cozy bonfire setups for a magical evening by the waves,
                        our
                        rental services have you covered.</p>
                </div>
            </div>
            <div class="service-section__item">
                <img class="service-content__img"
                    src="{{ asset('images/about/service-2.png') }}"
                    alt="">
                <div class="service-content">
                    <h2 class="service-content__title">Event Hosting</h2>
                    <p class="service-content__text">Dreaming of a beachfront wedding or an unforgettable celebration? Look no further. At Ngapali Paradise Hotel, we specialize in turning your special
                        moments into cherished memories.</p>
                </div>
            </div>
            <div class="service-section__item">
                <img class="service-content__img"
                    src="{{ asset('images/about/service-3.png') }}"
                    alt="">
                <div class="service-content">
                    <h2 class="service-content__title">Spa & Wellness</h2>
                    <p class="service-content__text">Indulge in relaxation and rejuvenation at our luxurious spa and wellness center. With the tranquil sound of the ocean as your backdrop, immerse
                        yourself in a world of serenity.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter newsletter--about">
        <h2 class="newsletter__title">Ready to Dive In? Book Your Stay Today</h2>

        <a class="newsletter__button button button--primary"
            href="{{ route('index') }}">Book Now</a>
    </section>
</x-app-layout>
