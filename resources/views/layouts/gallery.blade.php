<x-app-layout>
    <x-nav type="primary"></x-nav>

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

    <section class="gallery">
        <h2 class="gallery__title">Click one to <strong class="gallery__title--bold">embark</strong> your journey</h2>
        <div class="gallery__grid">
            <img class="gallery__image"
                src={{ asset('images/gallery/featured-1.png') }}>
            <img class="gallery__image"
                src={{ asset('images/gallery/dining-1.png') }}>
            <img class="gallery__image"
                src={{ asset('images/gallery/local-attractions-1.png') }}>
            <img class="gallery__image"
                src={{ asset('images/gallery/public-areas-1.png') }}>
            <img class="gallery__image"
                src={{ asset('images/gallery/leisure-1.png') }}>
            <img class="gallery__image"
                src={{ asset('images/gallery/exterior-1.png') }}>
        </div>
    </section>


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
