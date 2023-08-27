<x-app-layout>
    <x-nav type="primary"
        active="gallery"></x-nav>

    <!-- Hero Section Start-->
    <section class="hero hero--primary set-bg"
        data-set-bg="{{ asset('images/backgrounds/hero__gallery.png') }}">
        <div class="hero__content">
            <h2 class="hero__title">Hotel Gallery</h2>
            <h2 class="hero__subtitle">
                “Welcome to our breathtaking beach hotel gallery - a stunning collection of paradise-inspired coastal
                escapes and luxurious amenities.“
            </h2>
        </div>
    </section>

    @livewire('gallery-lightbox')


    <section class="newsletter">
        <h3 class="newsletter__heading">Newsletter</h3>
        <h2 class="newsletter__title">Subscribe to recieve our latest news and information</h2>

        <form class="newsletter-form"
            action="">
            <input class="newsletter-form__input"
                name="email"
                type="email"
                placeholder="Your Email">
            <button class="newsletter-form__button"
                type="submit">Submit</button>
        </form>
    </section>
</x-app-layout>
