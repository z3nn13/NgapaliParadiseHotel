<x-app-layout>
    <x-nav type="primary"></x-nav>
    <x-step-bar active=2></x-step-bar>

    @php
        $roomType = session('roomChoice');
        $roomDeal = session('dealChoice');
        $numNights = session('numNights');
        $numGuests = session('numGuests');
        $subTotal = $roomDeal->deal_usd;
        $totalAmount = $subTotal;
    @endphp

    <div class="container__booking-create">
        <div class="billing-grid">
            <div class="billing-summary">
                <h2 class="billing-summary__title">Billing Summary</h2>
                <div class="billing-summary__room-detail">
                    <div class="billing-summary__room-grid">
                        <img src="{{ asset($roomType->room_image) }}"
                            class="billing-summary__room-image billing-summary__room-grid--left" alt="Room-Image">
                        <div class="billing-summary__room-heading">
                            <div class="billing-summary__room-heading--left">
                                <p class="billing-summary__room-index text-sun-400">Room 1:</p>
                                <p class="billing-summary__room-name">{{ $roomType->room_type_name }}</p>
                            </div>

                            <div class="billing-summary__room-heading--right">
                                <img src="/images/svg/angle-down.svg" class="icon__angle-down">
                            </div>
                        </div>

                        <p class="billing-summary__room-price">$ {{ $roomDeal->deal_usd }}</p>
                    </div>

                    <p class="billing-summary__room-deal">
                        <span class="text-sun-400">Room Deal:</span> {{ $roomDeal->deal_name }}
                    </p>
                    <p class="billing-summary__room-extra">{{ $numNights }} Nights
                        {{ $numGuests }} Guests</p>
                </div>

                <div class="billing-summary__row billing-summary__row--right">
                    <a href="{{ route('booking.add-room') }}">+ Add Room</a>
                </div>

                <div class="billing-summary__row">
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
                <div class="billing-summary__row">
                    <p class="billing-summary__total-title">Total Amount</p>
                    <p class="billing-summary__total-value text-sun-400">$ {{ $totalAmount }}</p>
                </div>
            </div>
            <x-billing-form :totalAmount=$totalAmount></x-billing-form>
        </div>
    </div>
</x-app-layout>
