@props(['type' => 'landing', 'container' => 'landing'])
@php
    $minDate = date('Y-m-d');
    $maxDate = date('Y-m-d', strtotime('+1 month'));
    $input_fields = [
        [
            'label' => 'Arrival Date',
            'name' => 'arrivalDate',
            'type' => 'date',
            'min' => $minDate,
            'max' => '',
            'default' => '',
        ],
        [
            'label' => 'Departure Date',
            'name' => 'departureDate',
            'type' => 'date',
            'min' => $minDate,
            'max' => '',
            'default' => '',
        ],
        [
            'label' => 'Number Of Guests',
            'type' => 'number',
            'name' => 'numGuests',
            'min' => 1,
            'max' => 10,
            'default' => 1,
        ],
    ];
@endphp


<form @class([
    'booking__form',
    'booking__form--' . $type,
    'container--search',
]) method="GET" action="/search-results">
    <div class="booking__form__field-wrapper">
        @foreach ($input_fields as $field)
            {{-- Arrival Date --}}
            <div class="booking__form__field">
                <label class="booking__form__label" for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                <input class="booking__form__input" type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}" min="{{ $field['min'] }}" required
                    {{ $field['max'] != '' ? 'max=' . $field['max'] : '' }}
                    @if ($type == 'search') disabled
                        value={{ $_REQUEST[$field['name']] }}
                    @else
                        value={{ old($field['name']) ? old($field['name']) : $field['default'] }} @endif>
            </div>
        @endforeach
    </div>

    @if ($type == 'landing')
        <button class="booking__form__button button button--primary" type="submit">
            Book a stay
        </button>
    @elseif ($type == 'search')
        <a href="/">
            <button class="booking__form__button button button--special" type="button">
                Edit
            </button>
        </a>
    @endif
</form>
