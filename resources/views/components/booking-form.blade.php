@props(['type' => 'landing', 'container' => 'landing'])
@php
    $maxDate = date('Y-m-d', strtotime('+1 month'));
    $input_fields = [
        [
            'label' => 'Arrival Date',
            'name' => 'checkInDate',
            'type' => 'date',
            'min' => now()->toDateString(),
            'max' => '',
            'default' => '',
        ],
        [
            'label' => 'Departure Date',
            'name' => 'checkOutDate',
            'type' => 'date',
            'min' => now()->toDateString(),
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


<!-- Laravel Form -->
{{-- {!! Form::open([
    'route' => 'booking.index',
    'method' => 'POST',
    'class' => 'booking-form booking-form--' . $type . ' container--search',
]) !!} --}}
{{-- 
<div class="booking__form__field-wrapper">
    @foreach ($input_fields as $field)
        @php
        
        <div class="booking__form__field">
            {!! Form::label($field['name'], $field['label'], ['class' => 'booking__form__label']) !!}
            @if ($field['type'] == 'date')
            {!! Form::date($field["name"], $value, [$options]) !!}
        </div>
    @endforeach
</div>
{!! Form::close() !!} --}}



<!-- TODO: Use Laravel Forms -->
<form @class([
    'booking__form',
    'booking__form--' . $type,
    'container--search',
]) method="GET" action="{{ route('room-types.search') }}">
    <div class="booking__form__field-wrapper">
        @foreach ($input_fields as $field)
            <div class="booking__form__field">
                <label class="booking__form__label" for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                <input class="booking__form__input" type="{{ $field['type'] }}" name="{{ $field['name'] }}"
                    id="{{ $field['name'] }}" min="{{ $field['min'] }}" required
                    {{ $field['max'] != '' ? 'max=' . $field['max'] : '' }} {{ $type == 'search' ? 'disabled' : '' }}
                    value={{ Session::get($field['name'], $field['default']) }}>
            </div>
        @endforeach
    </div>


    @if ($type == 'landing')
        <button class="booking__form__button button button--primary" type="submit">
            Book a stay
        </button>
    @elseif ($type == 'search')
        <a href="{{ route('index') }}"class="booking__form__button button button--special">
            Edit
        </a>
    @endif
</form>
