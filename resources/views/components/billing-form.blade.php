@props(['totalAmount'])
<div class="billing-form">
    <h2 class="billing-form__title">Billing Info</h2>
    <h2 class="billing-form__subtitle">Choose a payment method and fill out the forms below</h2>
    <form
        class="billing-form__form"
        method="POST"
        action="{{ route('booking.confirm') }}"
    >
        @csrf
        <div class="billing-form__payment-group">
            <div class="billing-form__radio-group">
                <div class="billing-form__radio">
                    <input
                        name="payment_method"
                        type="radio"
                        value="1"
                        disabled
                        required
                    >
                    <span class="billing-form__radio-text">PayPal</span>
                </div>
                <div class="billing-form__radio">
                    <input
                        name="payment_method"
                        type="radio"
                        value="2"
                        required
                    >
                    <span class="billing-form__radio-text">Credit Card</span>
                </div>
            </div>
        </div>

        <h3 class="billing-form__group-title">
            Billing Details
        </h3>
        <div class="billing-form__group-layout">
            @auth
                <x-billing-form-group
                    id="first_name"
                    name="first_name"
                    type="text"
                    value="{{ auth()->user()->first_name }}"
                    readonly="readonly"
                >
                    First Name
                </x-billing-form-group>
                <x-billing-form-group
                    id="last_name"
                    name="last_name"
                    type="text"
                    value="{{ auth()->user()->last_name }}"
                    readonly="readonly"
                >
                    Last Name
                </x-billing-form-group>
                <x-billing-form-group
                    id="email"
                    name="email"
                    type="email"
                    value="{{ auth()->user()->email }}"
                    readonly="readonly"
                >
                    Email Address
                </x-billing-form-group>
                <x-billing-form-group
                    id="phone"
                    name="phone_no"
                    type="phone"
                    value="{{ auth()->user()->phone_no }}"
                    readonly="readonly"
                >
                    Phone Number
                </x-billing-form-group>
            @endauth

            @guest
                <x-billing-form-group
                    id="first_name"
                    name="first_name"
                    type="text"
                >First Name
                </x-billing-form-group>
                <x-billing-form-group
                    id="last_name"
                    name="last_name"
                    type="text"
                >Last Name
                </x-billing-form-group>
                <x-billing-form-group
                    id="email"
                    name="email"
                    type="email"
                >Email Address
                </x-billing-form-group>
                <x-billing-form-group
                    id="phone_no"
                    name="phone_no"
                    type="phone"
                >Phone Number</x-billing-form-group>
            @endguest


            <div class="billing-form__group">
                <label
                    class="billing-form__group-label"
                    for="country"
                >Country</label>
                <select
                    class="billing-form__group-input"
                    name="country"
                    required
                >
                    <option
                        value=""
                        readonly="readonly"
                        selected
                        hidden
                    >Select Country</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="USA">USA</option>
                </select>
            </div>

            <div class="billing-form__group">
                <label
                    class="billing-form__group-label"
                    for="currency"
                >Preferred Currency</label>
                <select
                    class="billing-form__group-input"
                    name="currency"
                    required
                >
                    <option value="MMK">MMK</option>
                    <option
                        value="USD"
                        selected
                    >USD</option>
                </select>
            </div>
        </div>

        <div class="center">
            <input
                name="totalAmount"
                type="hidden"
                value="{{ $totalAmount }}"
            >
            <button
                class="billing-form__button--submit button"
                type="submit"
            >Continue</button>
        </div>
    </form>
</div>
