<div class="position-relative">
    <form class="booking__form booking__form--{{ $pageType }} container--search"
        wire:submit.prevent="submit">
        <div class="booking__form__field-wrapper">
            <div class="booking__form__field">
                <label class="booking__form__label"
                    for="checkInDate">Arrival Date</label>
                <input class="booking__form__input"
                    type="date"
                    wire:model.lazy="checkInDate"
                    min="{{ now()->toDateString() }}"
                    {{ $inputsDisabled ? 'disabled' : '' }}
                    required>
                @error('checkInDate')
                    <span class="auth-input__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="booking__form__field">
                <label class="booking__form__label"
                    for="checkOutDate">Departure Date</label>
                <input class="booking__form__input"
                    type="date"
                    wire:model.lazy="checkOutDate"
                    min="{{ $minDate }}"
                    {{ $inputsDisabled ? 'disabled' : '' }}
                    required>

                @error('checkOutDate')
                    <span class="auth-input__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="booking__form__field">
                <label class="booking__form__label"
                    for="numGuests">Number Of Guests</label>
                <input class="booking__form__input"
                    type="number"
                    wire:model.lazy="numGuests"
                    min="1"
                    max="10"
                    {{ $inputsDisabled ? 'disabled' : '' }}
                    required>

                @error('numGuests')
                    <span class="auth-input__error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        @if ($pageType == 'landing')
            <button class="booking__form__button button button--primary"
                type="submit">
                Book a stay
            </button>
        @else
            <a class="booking__form__button button button--special"
                href="{{ route('index') }}">
                Edit
            </a>
        @endif
    </form>
</div>
