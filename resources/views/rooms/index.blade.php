<x-app-layout>
    <!-- Navigation Start -->
    <x-nav type="primary"></x-nav>

    <!-- Hero Section Start-->
    <section class="hero hero--primary set-bg" data-set-bg="{{ asset('images/backgrounds/hero__room.png') }}">
        <div class="hero__content">
            <h2 class="hero__title">Our Bed & Rooms</h2>
            <h2 class="hero__subtitle">
                “Indulge in the perfect coastal escape with our carefully curated selection of beachfront rooms.
                Each of our accommodations is designed to provide you with the ultimate blend of comfort.“
            </h2>
        </div>
    </section>

    <!-- Hero Section Start-->
    <div class="position-relative">
        <section class="category-select__container">
            <label class="category-select__label" for="categorySelect">
                Choose a
                <p class="category-select__label--bold">Category</p>
            </label>
            <select class="category-select__select select2" id="select2" name="categorySelect">
                <option></option>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
        </section>
    </div>

    <section class="rooms">
        <div class="room-card">
            <div class="room-card__image-wrapper">
                <img class="room-card__image" src="{{ asset('images/rooms/card-image.png') }}" alt="">
            </div>
            <div class="room-card__content">
                <h2 class="room-card__title">Deluxe Sea View Queen Bed</h2>
                <p class="room-card__text">Step into a timeless sanctuary with direct ocean access, where the
                    rhythmic embrace of blissful waves awaits you.</p>

                <div class="room-card__stats">
                    <div class="room-card__stat">
                        <img src="{{ asset('images/svgs/iconoir-user.svg') }}" alt="">
                        <p>3 Capacity</p>
                    </div>
                    <div class="room-card__stat">
                        <img src="{{ asset('images/svgs/la-bed.svg') }}" alt="">
                        <p>1 Queen Bed</p>
                    </div>
                </div>
                <footer class="room-card__footer">
                    <a href="{{ route('index') }}" class="room-card__cta room-card__cta--primary">Book Now</a>
                    <a href="{{ route('index') }}" class="room-card__cta room-card__cta--secondary">Learn More...</a>
                </footer>
            </div>
        </div>
    </section>
</x-app-layout>
