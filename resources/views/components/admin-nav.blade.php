@props(['active'])
@php
    $nav_items = ['Dashboard', 'Rooms', 'Users', 'Settings'];
@endphp


<section class="admin-layout"
    x-data="{ is_open: true }">
    <nav class="admin-sidebar">
        <div class="flex-container">
            <a href="{{ route('index') }}">
                <img class="admin-sidebar__logo"
                    src="{{ asset('images/logos/trial.png') }}"
                    alt="Logo">
            </a>

            <ul class="admin-sidebar__list">
                @foreach ($nav_items as $item)
                    @php
                        $is_active = $active == $item;
                    @endphp
                    <x-admin-sidebar-item :name=$item
                        :active=$is_active>
                    </x-admin-sidebar-item>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('admin.logout') }}"
            method="POST">
            @csrf
            <x-admin-sidebar-item name="Logout" />
        </form>
    </nav>


    <main class="admin-main">
        <nav class="admin-nav">
            <div class="admin-nav__item">
                <x-hamburger class="admin-nav__hamburger admin-sidebar__icon"
                    x-cloak></x-hamburger>
                <h1 class="admin-nav__title"
                    x-show="!is_open"
                    x-transition.duration.500ms
                    x-cloak>{{ $active }}</h1>
            </div>
            <div class="admin-nav__item">
                <p class="admin-nav__username">
                    {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}
                </p>
                <img class="admin-nav__profile-pic profile__picture"
                    src="{{ asset(auth()->user()->user_image) ?? asset('images/misc/no-image.png') }}"
                    alt="profile picture"
                    width="100">
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
                                <path stroke="black"
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
                                <form action="{{ route('admin.logout') }}"
                                    method="POST">
                                    @csrf
                                    <button class="dropdown__link"
                                        type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </x-dropdown>
            </div>
        </nav>
        {{ $slot }}
    </main>
</section>
