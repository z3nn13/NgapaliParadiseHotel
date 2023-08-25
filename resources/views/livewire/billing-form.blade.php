<div class="billing-form">
    <h2 class="billing-form__title">Billing Info</h2>
    <h2 class="billing-form__subtitle">Choose a payment method and fill out the forms below</h2>
    <form class="billing-form__form"
        wire:submit.prevent="submitForm">
        <div class="billing-form__payment-group">
            <div class="billing-form__radio-group">
                <div class="billing-form__radio">
                    <input type="radio"
                        value="1"
                        wire:model="paymentMethod"
                        disabled
                        required>
                    <span class="billing-form__radio-text">PayPal</span>
                </div>
                <div class="billing-form__radio">
                    <input type="radio"
                        value="2"
                        wire:model="paymentMethod"
                        required>
                    <span class="billing-form__radio-text">Credit Card</span>
                </div>
            </div>
        </div>

        <h3 class="billing-form__group-title">Billing Details</h3>
        <div class="billing-form__group-layout">
            @foreach (['first_name', 'last_name', 'email', 'phone_no'] as $field)
                @php
                    $camelCased = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $field))));
                    $spaced = ucwords(str_replace('_', ' ', $field));
                @endphp
                <x-billing-form-group name="$camelCased"
                    type="{{ $field === 'email' ? 'email' : 'text' }}"
                    :name='$camelCased'>
                    {{ $spaced }}
                </x-billing-form-group>
            @endforeach

            <div class="billing-form__group">
                <label class="billing-form__group-label"
                    for="country">Country</label>
                <select class="billing-form__group-input"
                    wire:model="country"
                    required>
                    <option value="Myanmar"
                        selected>Myanmar</option>
                    <option value="USA">USA</option>
                </select>
            </div>

            <div class="billing-form__group">
                <label class="billing-form__group-label"
                    for="currency">Preferred Currency</label>
                <select class="billing-form__group-input"
                    wire:model="preferredCurrency"
                    wire:loading.attr="disabled"
                    required>
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        </div>


        <div class="center">
            <button class="billing-form__button--submit button"
                type="submit">Continue</button>
        </div>
    </form>
</div>
