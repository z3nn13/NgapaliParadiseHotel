@props(['type' => 'primary'])
<nav {{ $attributes->merge(['class' => 'nav nav--' . $type]) }}>
    <ul class="nav__list">
        <a class="nav__link--home" href="\"><img class="nav__logo" src="/images/logos/trial.png" alt="logo"
            width="90"></a>
        <li class="nav__item"><a class="nav__link" href="{{ route('rooms.index') }}">rooms</a></li>
        <li class="nav__item"><a class="nav__link" href="{{ route('gallery.index') }}">gallery</a></li>
        <li class="nav__item"><a class="nav__link" href="{{ route('about.index') }}">about</a></li>
    </ul>

    @auth
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="nav__button button button--special" type="submit">Logout</button>
        </form>
    @else
        @if ($type !== 'auth')
            <div class="nav__cta nav__item">
                <a class="nav__button button button--special" href="/register">
                    Join Membership
                </a>
                <span class="nav__span">Get discounts up to 20%</span>
            </div>
        @endif
    @endauth
    <img class="nav__menu" src="/images/svg/nav-burger.svg" alt="nav-burger" />
</nav>
