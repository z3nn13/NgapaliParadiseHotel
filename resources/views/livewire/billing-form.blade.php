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

            <div class="billing-form__group"
                wire:ignore>
                <label class="billing-form__group-label"
                    for="country">Country</label>
                <select class="billing-form__group-input select2"
                    id="countrySelect"
                    required>
                    <option value="Myanmar"
                        selected>Myanmar</option>
                    <option value="USA">USA</option>
                </select>
            </div>

            <div class="billing-form__group"
                wire:ignore>
                <label class="billing-form__group-label"
                    for="currency">Preferred Currency</label>
                <select class="billing-form__group-input select2"
                    id="currencySelect"
                    required>
                    <option value="MMK">MMK</option>
                    <option value="USD">USD</option>
                </select>
            </div>

            <div class="center">
                <button class="billing-form__button--submit button"
                    type="submit">Continue</button>
            </div>
    </form>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "Please select an option",
                minimumResultsForSearch: 6,
            });

            $('#countrySelect, #currencySelect').select2();

            $('#countrySelect').on('change', function() {
                @this.set('country', $(this).val());
            });

            // Livewire integration for Preferred Currency select
            $('#currencySelect').on('change', function() {
                @this.set('preferredCurrency', $(this).val());
            });

            // Reflect wire:loading behavior for the Preferred Currency select
            Livewire.hook('message.processing', (message, component) => {
                if (message.from == 'preferredCurrency') {
                    $('#currencySelect').prop('disabled', true);
                }
            });

            Livewire.hook('message.processed', (message, component) => {
                if (message.from == 'preferredCurrency') {
                    $('#currencySelect').prop('disabled', false);
                    $('#currencySelect').trigger('change.select2'); // Trigger Select2 update
                }
            });
        });
    </script>
@endsection
