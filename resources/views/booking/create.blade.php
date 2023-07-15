<x-app-layout>
    <x-nav type="primary"></x-nav>
    <x-step-bar active=2></x-step-bar>

    @php
        $roomType = session('roomChoice');
        $roomDeal = session('dealChoice');
        $numNights = session('numNights');
        $numGuests = session('numGuests');
        $subTotal = $roomDeal->deal_mmk;
        $totalAmount = $subTotal;
    @endphp

    <div class="container__booking-create">
        <div class="billing-summary">
            <h2 class="billing-summary__title">billing Summary</h2>
            <div class="billing-summary__details">
                <div class="billing-summary__room-detail">

                    <div class="billing-summary__room-grid">
                        <img src="{{ $roomType->room_image }}" class="billing-summary__room-image">
                        <div class="billing-summary__room-heading">
                            <div class="billing-summary__room-heading--left">
                                <p class="billing-summary__room-index">Room 1:</p>
                                <p class="billing-summary__room-name">{{ $roomType->room_type_name }}</p>
                            </div>

                            <div class="billing-summary__room-heading--right">
                                <img src="images/auth/auth_bg.png" alt="">
                                <img src="images/svg/angle-down.svg" alt="" class="icon__angle-down">
                            </div>
                        </div>
                        <p class="billing-summary__room-price">MMK {{ $roomDeal->deal_mmk }}</p>
                    </div>

                    <p class="billing-summary__room-deal">{{ $roomDeal->name }}</p>
                    <p class="billing-summary__room-extra">{{ $numNights }} Nights
                        {{ $numGuests }} Guests</p>
                </div>
                <div class="billing-summary__row">
                    <a href="{{ route('booking.add-room') }}">+ Add Room</a>
                </div>

                <div class="billing-summary__row">
                    <p class="billing-summary__subtotal-title">Subtotal</p>
                    <p class="billing-summary__subtotal-value">{{ $subTotal }}</p>
                </div>

                <div class="billing-summary__row">
                    <p class="billing-summary__coupon-title">Coupon Code</p>
                    <input class="billing-summary__coupon-value">
                </div>
                <div class="billing-summary__row">
                    <a href="#">+ Special Request</a>
                </div>
                <div class="billing-summary__row">
                    <p class="billing-summary__total-title">Total Amount</p>
                    <p class="billing-summary__total-value">{{ $totalAmount }}</p>
                </div>
            </div>
        </div>
    </div>

    <x-billing-form></x-billing-form>
</x-app-layout>
