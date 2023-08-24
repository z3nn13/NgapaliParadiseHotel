<div class="billing-summary__item">
    <p class="billing-summary__room-extra">{{ session('booking.numNights') }} Nights {{ session('booking.numGuests') }} Guests</p>
</div>

<div class="billing-summary__item billing-summary__item--right">
    <p>+ Add Rooms</p>
</div>

<div class="billing-summary__item billing-summary__item--divider">
    <p class="billing-summary__subtotal-title">Subtotal</p>
    <p class="billing-summary__subtotal-value">{{ $subTotal }}</p>
</div>

<div class="billing-summary__item">
    <p class="billing-summary__coupon-title">Coupon Code</p>
    <div class="billing-summary__coupon">
        <input class="billing-summary__coupon-input"
            wire:model='couponCode' />
        @if ($this->coupon && $this->couponCode)
            <p class="billing-summary__coupon-success">
                {{ $this->coupon->discount_percentage }}% discount applied!
            </p>
        @endif
        @error('couponCode')
            <p class="billing-summary__coupon-error">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="billing-summary__item billing-summary__item--right">
    <p>+ Special Requests</p>
</div>

<div class="billing-summary__item billing-summary__item--divider">
    <span class="billing-summary__total-title">Total Amount</span>
    <span class="billing-summary__total-value text-sun-400">{{ $totalAmount }}</span>
</div>
