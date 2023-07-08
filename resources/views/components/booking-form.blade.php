@props(['type' => 'unfilled'])
<form {{ $attributes->merge(['class' => 'booking__form booking__form--' . $type]) }} method="GET"
    action="/search-results">
    <div class="booking__form__field-wrapper">
        {{-- Arrival Date --}}
        <div class="booking__form__field">
            <label class="booking__form__label" for="arrivalDate">Arrival Date</label>
            <input class="booking__form__input" type="date" name="arrivalDate" id="arrivalDate" min="{{ date('Y-m-d') }}"
                {{ $type == 'filled' ? 'disabled' : '' }} required
                value={{ $type == 'filled' ? $_REQUEST['arrivalDate'] : old('arrivalDate') }}>
        </div>

        {{-- Departure Date --}}
        <div class="booking__form__field">
            <label class="booking__form__label" for="departureDate">Departure Date</label>
            <input class="booking__form__input" type="date" name="departureDate" id="departureDate"
                min="{{ date('Y-m-d') }}" {{ $type == 'filled' ? 'disabled' : '' }} required
                value={{ $type == 'filled' ? $_REQUEST['departureDate'] : old('departureDate') }}>
        </div>

        {{-- Number of Guests --}}
        <div class="booking__form__field">
            <label class="booking__form__label" for="numGuests">Number of Guests</label>
            <input class="booking__form__input" type="number" name="numGuests" id="numGuests" max=10
                {{ $type == 'filled' ? 'disabled' : '' }} required
                value={{ $type == 'filled' ? $_REQUEST['numGuests'] : old('numGuests') }}>
        </div>
    </div>

    @if ($type == 'unfilled')
        <button class="booking__form__button button button--primary" type="submit">
            Book a stay
        </button>
    @else
        <button class="booking__form__button button button--special" type="submit">
            Edit
        </button>
    @endif

</form>
