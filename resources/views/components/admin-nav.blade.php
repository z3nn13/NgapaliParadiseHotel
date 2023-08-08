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
                    src="{{ asset('images/backgrounds/hero__room.png') }}"
                    alt="profile picture"
                    width="100">
            </div>
        </nav>
        {{ $slot }}
    </main>
</section>
