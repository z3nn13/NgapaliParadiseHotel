<x-app-layout>
    <x-nav type="primary"></x-nav>
    <x-step-bar active=3></x-step-bar>

    @php
        $reservation_rooms = session('reservation_rooms');
        $subTotal = 0;
    @endphp

    <div class="container__booking--create">
        <div class="green__background">
        </div>
        <section class="billing-grid billing-grid--confirm">
            <div class="billing-summary">
                <h2 class="billing-summary__title">Billing Summary</h2>
                @foreach ($reservation_rooms as $room)
                    <div class="billing-summary__room-detail"
                        x-data="{ open: false }">
                        <div class="billing-summary__room-grid">
                            <img class="billing-summary__room-image billing-summary__room-grid--left"
                                src="{{ asset($room['roomType']->room_image) }}"
                                alt="Room-Image"
                                x-transition
                                x-show="open">
                            <div class="billing-summary__room-heading">
                                <div class="billing-summary__room-heading--left">
                                    <p class="billing-summary__room-index text-sun-400">Room {{ $loop->index + 1 }}:</p>
                                    <p class="billing-summary__room-name">{{ $room['roomType']->room_type_name }}
                                    </p>
                                </div>

                                <button class="billing-summary__room-heading--right billing-summary__angle-down"
                                    @click="open = !open">
                                    <img class="icon__angle-down"
                                        src="/images/svg/angle-down.svg">
                                </button>
                            </div>

                            <p class="billing-summary__room-price">$ {{ $room['roomDeal']->deal_usd }}</p>
                        </div>

                        <div class="billing-summary__room-body"
                            x-show="open"
                            x-transition>
                            <p class="billing-summary__room-deal">
                                <span class="text-sun-400">Room Deal:</span> {{ $room['roomDeal']->deal_name }}
                            </p>
                        </div>
                    </div>
                    @php
                        $subTotal += $room['roomDeal']->deal_usd;
                    @endphp
                @endforeach

                <div class="billing-summary__row">
                    <p class="billing-summary__room-extra">{{ session('numNights') }} Nights
                        {{ session('numGuests') }} Guests</p>
                </div>

                <div class="billing-summary__row billing-summary__row--divider">
                    <p class="billing-summary__subtotal-title">Subtotal</p>
                    <p class="billing-summary__subtotal-value">$ {{ $subTotal }}</p>
                </div>

                <div class="billing-summary__row">
                    <p class="billing-summary__coupon-title">Coupon Code</p>
                    <input class="billing-summary__coupon-input"
                        disabled />
                </div>
                <div class="billing-summary__row billing-summary__row--right">
                    <p>Special Requests: inluded</p>
                </div>
                <div class="billing-summary__row billing-summary__row--divider">
                    <p class="billing-summary__total-title">Total Amount</p>
                    <p class="billing-summary__total-value text-sun-400">$ {{ $subTotal }}</p>
                </div>
                <div class="billing-summary__row">
                    <form action="{{ route('booking.create', ['goBack' => true]) }}"
                        method="POST">
                        @csrf

                        <button class="billing-summary__button billing-summary__button--back">
                            <img src="{{ asset('images/svgs/bx-arrow-back.svg') }}"
                                alt=""> Back</button>
                    </form>

                    <a class="billing-summary__button billing-summary__button--confirm"
                        href="{{ route('booking.payment') }}">
                        I Confirm
                    </a>

                </div>
            </div>
        </section>
        <section class="billing-main">
            <h1 class="billing-main__title">Confirm <br>Your Reservation?</h1>
            <image class="billing-main__image"
                src="{{ asset('images/misc/billing-confirm.png') }}">
        </section>

    </div>
</x-app-layout>
