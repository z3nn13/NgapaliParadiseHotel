@props(['totalAmount'])
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
                    <input type="radio" name="payment_method" value="card" required>
                    <span class="billing-form__radio-text">Credit Card</span>
                </div>
            </div>
        </div>

        <h3 class="billing-form__group-title">
            Billing Details
        </h3>
        <div class="billing-form__group-layout">
            @auth
                <x-billing-form-group type="text" id="first_name" name="first_name"
                    value="{{ auth()->user()->first_name }}">
                    First Name
                </x-billing-form-group>
                <x-billing-form-group type="text" id="last_name" name="last_name"
                    value="{{ auth()->user()->last_name }}">
                    Last Name
                </x-billing-form-group>
                <x-billing-form-group type="email" id="email" name="email" value="{{ auth()->user()->email }}">
                    Email Address
                </x-billing-form-group>
                <x-billing-form-group type="phone" id="phone" name="phone_no" value="{{ auth()->user()->phone_no }}">
                    Phone Number
                </x-billing-form-group>
            @endauth

            @guest
                <x-billing-form-group type="text" id="first_name" name="first_name">First Name
                </x-billing-form-group>
                <x-billing-form-group type="text" id="last_name" name="last_name">Last Name
                </x-billing-form-group>
                <x-billing-form-group type="email" id="email" name="email">Email Address
                </x-billing-form-group>
                <x-billing-form-group type="phone" id="phone_no" name="phone_no">Phone Number</x-billing-form-group>
            @endguest
            <div class="billing-form__group">
                <label for="country" class="billing-form__group-label">Country</label>
                <select class="billing-form__group-input" name="country" required>
                    <option value="" disabled selected hidden>Select Country</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="USA">Usa</option>
                </select>
            </div>

            <div class="billing-form__group">
                <label for="currency" class="billing-form__group-label">Preferred Currency</label>
                <select class="billing-form__group-input" name="currency" required>
                    <option value="MMK">MMK</option>
                    <option value="USD" selected>USD</option>
                </select>
            </div>
        </div>

        <div class="center">
            <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
            <button type="submit" class="billing-form__button--submit button">Continue</button>
        </div>
    </form>
</div>
