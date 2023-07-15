@props(['type' => 'primary'])
<nav {{ $attributes->merge(['class' => 'nav nav--' . $type]) }}>
    <ul class="nav__list">
        <a class="nav__link--home" href="\"><img class="nav__logo" src="/images/logos/white_text.png" alt="logo"
            width="100"></a>
        <li class="nav__item"><a class="nav__link" href="/rooms">rooms</a></li>
        <li class="nav__item"><a class="nav__link" href="/gallery">gallery</a></li>
        <li class="nav__item"><a class="nav__link" href="/about">about</a></li>
    </ul>

    @auth
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <div class="nav__cta nav__item">
            <a class="nav__button button button--special" href="/register">
                Join Membership
            </a>
            <span class="nav__span">Get discounts up to 20%</span>
        </div>
    @endauth
    <img class="nav__menu" src="images/svg/nav-burger.svg" alt="nav-burger" />
</nav>
