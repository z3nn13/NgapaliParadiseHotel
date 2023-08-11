@props(['type' => 'primary'])
<nav {{ $attributes->merge(['class' => 'nav nav--' . $type]) }}>
    <ul class="nav__list">
        <a class="nav__link--home"
            href="\"><img class="nav__logo"
            src="/images/logos/trial.png"
            alt="logo"
            width="90"></a>
        <li class="nav__item"><a class="nav__link"
                href="{{ route('rooms.index') }}">rooms</a></li>
        <li class="nav__item"><a class="nav__link"
                href="{{ route('gallery.index') }}">gallery</a></li>
        <li class="nav__item"><a class="nav__link"
                href="{{ route('about.index') }}">about</a></li>
    </ul>

    @auth
        <div class="admin-nav__item">
            <img class="admin-nav__profile-pic profile__picture"
                src="{{ asset(auth()->user()->user_image) ?? asset('images/misc/no-image.png') }}"
                alt="profile picture"
                width="100">
            <p class="admin-nav__username">
                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
            </p>

            <img src="{{ asset('images/svg/angle-down.svg') }}"
                alt=""
                width="10px">
            {{-- 
            <!-- Authentication -->
            <form method="POST"
                action="{{ route('logout') }}">
                @csrf
                <button class="nav__button button button--special"
                    type="submit">Logout</button>
            </form>
        </div> --}}
        @else
            @if ($type !== 'auth')
                <div class="nav__cta nav__item">
                    <a class="nav__button button button--special"
                        href="/register">
                        Join Membership
                    </a>
                    <span class="nav__span">Get discounts up to 20%</span>
                </div>
            @endif
        @endauth
        <div class="nav__menu"
            x-data="{ is_open: true }">
            <x-hamburger></x-hamburger>
        </div>
</nav>
