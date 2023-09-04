<ul class="booking-card__list">
    <li class="booking-card__item booking-card__item--no-bottom">
        <p class="booking-card__text--special booking-card__text--no-break">1 Nights 2 Guests</p>
    </li>
    @if ($active)
        <li class="booking-card__item booking-card__item--no-bottom booking-card__item--flat booking-card__item--right">
            <a class="booking-card__text--bright booking-card__text--no-break booking-card__link"
                href="{{ route('booking.search') }}">+ ADD ROOMS</a>
        </li>
    @endif
    <li class="booking-card__item booking-card__item--border-top">
        <h3 class="booking-card__label">Subtotal</h3>
        <span class="booking-card__value">{{ $subTotal }}</span>
    </li>
    <li class="booking-card__item">
        <h3 class="booking-card__label">Coupon Code</h3>
        <div class="booking-card__coupon-container">
            <input class="booking-card__coupon-input"
                value="{{ $active ? '' : ($coupon ? $coupon->coupon_code : '') }}"
                wire:model.debounce.400ms='couponCode'
                wire:loading.attr='disabled'
                {{ $active ?: 'disabled' }}>
            @if ($coupon)
                @if ($couponCode)
                    <p class="billing-summary__coupon-success">
                        {{ $coupon->discount_percentage }}% discount applied!
                    </p>
                @endif
            @endif
            @error('couponCode')
                <p class="billing-summary__coupon-error">{{ $message }}</p>
            @enderror
        </div>
    </li>
    <li class="booking-card__item booking-card__item--no-bottom booking-card__item--last">
        <h3 class="
        booking-card__label 
        booking-card__text--bright 
        booking-card__text--big 
        booking-card__text--no-break">Total Amount</h3>
        <span class="booking-card__text--tinted booking-card__text--large booking-card__text--no-break">{{ $totalAmount }}</span>
    </li>
</ul>
