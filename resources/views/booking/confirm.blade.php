<x-app-layout>
    <x-nav type="primary"></x-nav>
    <x-step-bar active=3></x-step-bar>

    @php
        $reservation_rooms = session('booking.reservation_rooms');
        $billingData = session('booking.billingData');
        $subTotal = $billingData['subTotal'];
        $totalAmount = $billingData['totalAmount'];
        $unit = '';
        $unit = $billingData['preferredCurrency'] === 'MMK' ? 'Ks.' : "$";
        $coupon = $billingData['coupon'];
        
    @endphp

    <div class="container__booking--create">
        <div class="green__background">
        </div>
        <section class="billing-grid billing-grid--confirm">
            <div class="billing-summary">
                <h2 class="billing-summary__title">Billing Summary</h2>
                @foreach ($reservation_rooms as $room)
                    @php
                        $roomDeal = $room['roomDeal'];
                        $roomType = $room['roomType'];
                        $roomPrice = $billingData['preferredCurrency'] === 'MMK' ? $roomDeal->deal_mmk : $roomDeal->deal_usd();
                        $iteration = $loop->iteration;
                    @endphp

                    <div class="billing-summary__room-detail"
                        x-data="{ open: false }">
                        <div class="billing-summary__room-grid">
                            <img class="billing-summary__room-image billing-summary__room-grid--left"
                                src="{{ asset($roomType->room_image) }}"
                                alt="Room-Image"
                                x-transition
                                x-show="open">
                            <div class="billing-summary__room-heading">
                                <div class="billing-summary__room-heading--left">
                                    <p class="billing-summary__room-index text-sun-400">Room {{ $iteration }}:</p>
                                    <p class="billing-summary__room-name">{{ $roomType->room_type_name }}
                                    </p>
                                </div>

                                <button class="billing-summary__room-heading--right billing-summary__dropdown-trigger"
                                    @click="open = !open"
                                    :class="{ 'billing-summary__dropdown-trigger--active': open }">
                                    <img class="icon__angle-down"
                                        src="/images/svg/angle-down.svg">
                                </button>
                            </div>


                            <p class="billing-summary__room-price">{{ $unit }} {{ $roomPrice }}</p>
                        </div>

                        <div class="billing-summary__room-body"
                            x-show="open"
                            x-transition>
                            <p class="billing-summary__room-deal">
                                <span class="text-sun-400">Room Deal:</span> {{ $roomDeal->deal_name }}
                            </p>
                        </div>
                    </div>
                @endforeach

                <div class="billing-summary__item">
                    <p class="billing-summary__room-extra">{{ session('booking.numNights') }} Nights
                        {{ session('booking.numGuests') }} Guests</p>
                </div>

                <div class="billing-summary__item billing-summary__item--divider">
                    <p class="billing-summary__subtotal-title">Subtotal</p>
                    <p class="billing-summary__subtotal-value">{{ $unit }} {{ $subTotal }}</p>
                </div>

                <div class="billing-summary__item">
                    <p class="billing-summary__coupon-title">Coupon Code</p>
                    <div class="billing-summary__coupon">
                        @if ($coupon)
                            <input class="billing-summary__coupon-input"
                                value="{{ $coupon->coupon_code }}"
                                disabled />
                            <p class="billing-summary__coupon-success">
                                {{ $coupon->discount_percentage }}% discount applied!
                            </p>
                        @else
                            <input class="billing-summary__coupon-input"
                                disabled />
                        @endif
                    </div>
                </div>
                <div class="billing-summary__item billing-summary__item--right">
                    <p>Special Requests: included</p>
                </div>
                <div class="billing-summary__item billing-summary__item--divider">
                    <p class="billing-summary__total-title">Total Amount</p>
                    <p class="billing-summary__total-value text-sun-400">{{ $unit }} {{ $totalAmount }}</p>
                </div>
                <div class="billing-summary__item">
                    <a class="billing-summary__button billing-summary__button--back"
                        href="{{ route('booking.create') }}">
                        <img src="{{ asset('images/svgs/bx-aritem-back.svg') }}"
                            alt=""> Back</a>

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
