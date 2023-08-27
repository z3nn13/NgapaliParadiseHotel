@props(['type' => 'primary', 'active' => ''])
<nav {{ $attributes->merge(['class' => 'nav nav--' . $type]) }}>
    <ul class="nav__list">
        <a class="nav__link--home"
            href="\"><img class="nav__logo"
            src="/images/logos/trial.png"
            alt="logo"
            width="90"></a>
        <li class="nav__item">
            <a class="nav__link {{ $active === 'rooms' ? 'nav__link--active' : '' }}"
                href="{{ route('rooms.index') }}">rooms</a>
        </li>
        <li class="nav__item">
            <a class="nav__link {{ $active === 'gallery' ? 'nav__link--active' : '' }}"
                href="{{ route('gallery.index') }}">gallery</a>
        </li>
        <li class="nav__item">
            <a class="nav__link {{ $active === 'about' ? 'nav__link--active' : '' }}""
                href="{{ route('about.index') }}">about</a>
        </li>
    </ul>

    @auth
        <div class="nav__item nav__item--auth"
            x-data="{ nav_dropdown: false }">
            <img class="admin-nav__profile-pic profile__picture"
                src="{{ asset(auth()->user()->user_image) }}">
            <p class="admin-nav__username">
                {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
            </p>
            <x-dropdown>
                <div class="dropdown">
                    <x-slot name="trigger">
                        <svg class="dropdown__trigger"
                            aria-hidden="true"
                            :class="{ 'dropdown__trigger--active': dropdown }"
                            width="10"
                            height="10"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 8">
                            <path stroke="white"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
                        </svg>
                    </x-slot>

                    <ul class="dropdown__container"
                        :class="dropdownPosition"
                        x-cloak
                        x-ref="container">
                        <li class="dropdown__option">
                            <a class="dropdown__link"
                                href="{{ route('dashboard') }}">
                                <svg class="admin-sidebar__icon dropdown__icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="1024"
                                    height="1024"
                                    viewBox="0 0 1024 1024">
                                    <path fill="currentColor"
                                        d="M288 320a224 224 0 1 0 448 0a224 224 0 1 0-448 0zm544 608H160a32 32 0 0 1-32-32v-96a160 160 0 0 1 160-160h448a160 160 0 0 1 160 160v96a32 32 0 0 1-32 32z" />
                                </svg>
                                Dashboard</a>
                        </li>
                        <li class="dropdown__option">
                            <form action="{{ route('logout') }}"
                                method="POST">
                                @csrf
                                <button class="dropdown__link"
                                    type="submit">
                                    <svg class="admin-sidebar__icon dropdown__icon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="32"
                                        height="32"
                                        viewBox="0 0 32 32"
                                        fill="none">
                                        <path fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M4 6.66667C4 5.2 5.2 4 6.66667 4H17.3333V6.66667H6.66667V25.3333H17.3333V28H6.66667C5.2 28 4 26.8 4 25.3333V6.66667ZM22.9013 14.6667L19.52 11.2853L21.4053 9.4L28.0053 16L21.4053 22.6L19.52 20.7147L22.9013 17.3333H14.12V14.6667H22.9013Z"
                                            fill="currentColor" />
                                    </svg>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </x-dropdown>
        </div>
    @else
        @if ($type !== 'auth')
            <div class="nav__cta nav__item">
                <a class="nav__button button button--special"
                    href="/register">
                    Join Membership
                </a>
            </div>
        @endif
    @endauth
    <div class="nav__menu"
        x-data="{ is_open: true }">
        <x-hamburger></x-hamburger>
    </div>
</nav>
