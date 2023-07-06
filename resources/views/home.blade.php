<x-layout>
    {{-- Hero Section --}}
    <section class="hero">
        <div class="hero__content">
            <div class="hero__content--wrapper">
                <h2 class="hero__heading">Come Experience</h2>
                <h2 class="hero__title">
                    Coastal<br>
                    Luxury At<br>
                    Its Finest<br>
                    & Exquisite</h2>
                <span class="hero__span">Plan your dream vacation by the beach</span>
            </div>
        </div>
        <div class="hero__image-wrapper">
            <img class="hero__image" src="/images/home/hero_bg.png" alt="image of a house">
        </div>

        <form class="form form_type_booking" method="GET" action="/booking">
            <div class="form__field-wrapper">
                <div class="form__field">
                    <label class="form__label" for="arrivalDate">Arrival Date</label>
                    <input class="form__input" type="date" name="arrivalDate" id="arrivalDate">
                </div>
                <div class="form__field">
                    <label class="form__label" for="departureDate">Departure Date</label>
                    <input class="form__input" type="date" name="departureDate" id="departureDate">
                </div>
                <div class="form__field">
                    <label class="form__label" for="numGuests">Number of Guests</label>
                    <input class="form__input" type="number" name="numGuests" id="numGuests">
                </div>
            </div>
            <button class="form__button button button--primary">
                Book a stay
            </button>
        </form>

    </section>


    {{-- Wave Section --}}
    <section class="wave-section">
        <div class="wave-section__content">
            <h2>Discover the perfect
                blend of warmth, and coastal charm.</h2>
        </div>
        <img class="wave-section__image" src="/images/home/waves.png" alt="image of waves">
    </section>


    {{-- Pool Section --}}
    <section class="pool-section">
        <img class="pool-section__image" src="/images/home/pool.png" alt="image of a pool">
        <div class="pool-section__content">
            <p class="pool-section__paragraph">
                Unwind upon the allure of our beachside hotel, where<br>
                pristine beaches beckon and a sparkling pool<br>
                awaits, offering a blissful oasis for your<br>
                unforgettable escape.<br>
            </p>
            <a href="/about">
                <button class="button button--primary">
                    <span class="button__body">Our Story</span>
                    <span class="button__append"><i class="fa-solid fa-arrow-right"></i></span>
                </button>
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
            <a href="/rooms">
                <button class="room-section__button--primary button button--primary">
                    <span class="button__body">Discover Room</span>
                </button>
            </a>
            <a href="/register">
                <button class="room-section__button--secondary button button--secondary">
                    <span class="button__body">Join Membership</span>
                </button>
            </a>
        </div>

        <div class="room-section__image-layout">
            <img class="room-section__image room-section__image--left" src="/images/home/room_1.png">
            <img class="room-section__image room-section__image--top-right" src="/images/home/room_2.png">
            <img class="room-section__image room-section__image--bottom-right" src="/images/home/room_3.png">
        </div>
    </section>
</x-layout>