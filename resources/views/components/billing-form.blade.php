<div class="billing-form">
    <h2 class="billing-form__title">Billing Info</h2>
    <h2 class="billing-form__subtitle">Choose a payment method and fill out the forms below</h2>
    <form class="billing-form__form"
        method="POST"
        action="{{ route('booking.confirm') }}">
        @csrf
        <div class="billing-form__payment-group">
            <div class="billing-form__radio-group">
                <div class="billing-form__radio">
                    <input name="payment_method"
                        type="radio"
                        value="1"
                        disabled
                        required>
                    <span class="billing-form__radio-text">PayPal</span>
                </div>
                <div class="billing-form__radio">
                    <input name="payment_method"
                        type="radio"
                        value="2"
                        required>
                    <span class="billing-form__radio-text">Credit Card</span>
                </div>
            </div>
        </div>

        <h3 class="billing-form__group-title">
            Billing Details
        </h3>
        <div class="billing-form__group-layout">
            @foreach (['first_name', 'last_name', 'email', 'phone_no'] as $field)
                <x-billing-form-group id="{{ $field }}"
                    name="{{ $field }}"
                    type="{{ $field === 'email' ? 'email' : 'text' }}">
                    {{ ucwords(str_replace('_', ' ', $field)) }}
                </x-billing-form-group>
            @endforeach

            <div class="billing-form__group">
                <label class="billing-form__group-label"
                    for="country">Country</label>
                <select class="billing-form__group-input"
                    name="country"
                    required>
                    <option value=""
                        readonly="readonly"
                        selected
                        hidden>Select Country</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="USA">USA</option>
                </select>
            </div>


            <div class="billing-form__group">
                <label class="billing-form__group-label"
                    for="currency">Preferred Currency</label>
                <select class="billing-form__group-input"
                    name="currency"
                    wire:model="preferredCurrency"
                    required>
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>



        <div class="center">
            @if ($coupon)
                <input name="coupon"
                    type="hidden"
                    value="{{ json_encode($coupon) }}">
            @endif
            <input name="subTotal"
                type="hidden"
                value="{{ $subTotal }}" />

            <input name="totalAmount"
                type="hidden"
                value="{{ $totalAmount }}" />

            <button class="billing-form__button--submit button"
                type="submit">Continue</button>
        </div>
    </form>
</div>
