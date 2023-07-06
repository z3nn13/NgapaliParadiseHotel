<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ngapali Paradise Hotel | </title>

    {{-- Dependencies --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])


    {{-- CDNs --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Sacramento&family=Newsreader:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

</head>

<body>

    <div class="flex-container">

        {{-- Start Navigation Bar --}}
        <nav class="nav nav_type_landing">
            <ul class="nav__list">
                <li class="nav__item">
                    <img class="nav__logo" src="/images/logos/white_text.png" alt="logo" width="100">
                </li>
                <li class="nav__item"><a class="nav__link" href="">rooms</a></li>
                <li class="nav__item"><a class="nav__link" href="">contact</a></li>
                <li class="nav__item"><a class="nav__link" href="">about</a></li>
            </ul>
            <div class="nav__cta">
                <a href="/register"></a>
                <button class="button button--special">Join Membership</button>
                <span class="nav__contact">Call Us: +95-95-116-983</span>
            </div>
        </nav>
        {{-- End Navigation Bar --}}



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
            <img class="hero__image" src="/images/home/hero_bg.png" alt="image of a house">

            {{-- <form class="form form_type_booking" action="post">
                <div class="form__fields">
                    <label class="form__label" for="arrivalDate">Arrival Date</label>
                    <input class="form__input" type="date" name="arrivalDate" id="arrivalDate">
                </div>
                <div class="form__fields">
                    <label class="form__label" for="departureDate">Departure Date</label>
                    <input class="form__input" type="date" name="departureDate" id="departureDate">
                </div>
                <div class="form__fields">
                    <label class="form__label" for="numGuests">Number of Guests</label>
                    <input class="form__input" type="number" name="numGuests" id="numGuests">
                </div>
            </form>
            --}}
        </section>
    </div>


    <main>
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
                    {{-- Unwind upon the allure of our beachside hotel, where
                    pristine beaches beckon and a sparkling pool
                    awaits, offering a blissful oasis for your
                    unforgettable escape. --}}
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
    </main>


    <footer class="footer" style="background-image: url('images/home/footer.jpg');">
        <div class="footer__wrapper">
            <img class=" footer__logo" src="/images/logos/white_text.png" alt="logo">
            <div class="footer__details">
                <span class="footer__span">Ngapali Main Rd,<br>Thandwe, Myanmar 1221</span>
                <span class="footer__span">(+95) 951-1663</span>
                <span class="footer__span">ngapaliparadisehotel@gmail.com</span>
            </div>
            <ul class="footer__socials">
                <li class="footer__icon"><i class="fa-brands fa-square-facebook"></i></li>
                <li class="footer__icon"><i class="fa-brands fa-instagram"></i></li>
                <li class="footer__icon"><i class="fa-brands fa-twitter"></i></li>
            </ul>
            <nav class="footer__nav nav">
                <li class="nav__item"><a class="nav__link" href="">rooms</a></li>
                <li class="nav__item"><a class="nav__link" href="">contact</a></li>
                <li class="nav__item"><a class="nav__link" href="">about</a></li>
                <li class="nav__item"><a class="nav__link" href="">gallery</a></li>
            </nav>
            <span class="footer__copyright">© Copyright 2022 all rights reserved</span>
        </div>
    </footer>
</body>

</html>