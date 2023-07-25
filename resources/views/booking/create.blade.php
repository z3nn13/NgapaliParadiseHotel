<x-app-layout>
    <x-nav type="primary"></x-nav>
    <x-step-bar active=2></x-step-bar>

    @php
        $reservation_rooms = session('reservation_rooms');
        $subTotal = 0;
    @endphp
    <div class="container__booking--create">
        <div class="green__background">
        </div>
        <div class="billing-grid billing-grid--create">
            <div class="billing-summary">
                <h2 class="billing-summary__title">Billing Summary</h2>
                @foreach ($reservation_rooms as $room)
                    <div class="billing-summary__room-detail">
                        <div class="billing-summary__room-grid">
                            <img class="billing-summary__room-image billing-summary__room-grid--left"
                                src="{{ asset($room['roomType']->room_image) }}"
                                alt="Room-Image">
                            <div class="billing-summary__room-heading">
                                <div class="billing-summary__room-heading--left">
                                    <p class="billing-summary__room-index text-sun-400">Room 1:</p>
                                    <p class="billing-summary__room-name">{{ $room['roomType']->room_type_name }}
                                    </p>
                                </div>

                                <div class="billing-summary__room-heading--right">
                                    <img class="icon__angle-down"
                                        src="/images/svg/angle-down.svg">
                                </div>
                            </div>

                            <p class="billing-summary__room-price">$ {{ $room['roomDeal']->deal_usd }}</p>
                        </div>

                        <p class="billing-summary__room-deal">
                            <span class="text-sun-400">Room Deal:</span> {{ $room['roomDeal']->deal_name }}
                        </p>
                        <p class="billing-summary__room-extra">{{ session('numNights') }} Nights
                            {{ session('numGuests') }} Guests</p>
                    </div>
                    @php
                        $subTotal += $room['roomDeal']->deal_usd;
                    @endphp
                @endforeach

                <div class="billing-summary__row billing-summary__row--right">
                    <a href="{{ route('booking.add-room') }}">+ Add Room</a>
                </div>

                <div class="billing-summary__row billing-summary__row--divider">
                    <p class="billing-summary__subtotal-title">Subtotal</p>
                    <p class="billing-summary__subtotal-value">$ {{ $subTotal }}</p>
                </div>

                <div class="billing-summary__row">
                    <p class="billing-summary__coupon-title">Coupon Code</p>
                    <input class="billing-summary__coupon-input" />
                </div>
                <div class="billing-summary__row billing-summary__row--right">
                    <a href="#">+ Special Request</a>
                </div>
                <div class="billing-summary__row billing-summary__row--divider">
                    <p class="billing-summary__total-title">Total Amount</p>
                    <p class="billing-summary__total-value text-sun-400">$ {{ $subTotal }}</p>
                </div>
            </div>
            <x-billing-form :totalAmount=$subTotal></x-billing-form>
        </div>
    </div>
</x-app-layout>
