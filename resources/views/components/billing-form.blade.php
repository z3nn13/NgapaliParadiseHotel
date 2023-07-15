<div class="billing-form">
    <h2 class="billing-form__title">Billing Info</h2>
    <h2 class="billing-form__subtitle">Choose a payment method and fill out the forms below</h2>
    <form class="billing-form__form" method="POST" action="{{ route('booking.confirm') }}">
        @csrf
        <div class="billing-form__payment-group">
            <div class="billing-form__radio-group">
                <div class="billing-form__radio">
                    <input type="radio" name="payment_method" value="paypal" required>
                    <span class="billing-form__radio-text">PayPal</span>
                </div>
                <div class="billing-form__radio">
                    <input type="radio" name="payment_method" value="stripe" required>
                    <span class="billing-form__radio-text">Credit Card</span>
                </div>
            </div>
        </div>

        <div class="billing-form__group-container">
            <h3 class="billing-form__group-title">
                $ Billing Details
            </h3>
            <x-billing-form-group type="text" id="name" name="name">First Name
            </x-billing-form-group>
            <x-billing-form-group type="text" id="name" name="name">Last Name
            </x-billing-form-group>
            <x-billing-form-group type="email" id="email" name="email">Email Address
            </x-billing-form-group>
            <x-billing-form-group type="phone" id="phone" name="phone">Phone Number</x-billing-form-group>
            <x-billing-form-group type="text" id="country" name="country">Country</x-billing-form-group>
            <x-billing-form-group type="text" id="currency" name="currency">Preferred Currency
            </x-billing-form-group>
        </div>

        <button type="submit" class="billing-form__submit">Proceed</button>
    </form>
</div>
