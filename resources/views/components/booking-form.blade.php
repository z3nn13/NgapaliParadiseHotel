@props(['type' => 'landing'])

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

<!-- Booking Form -->
<section class="position-relative">

    <form class="booking__form booking__form--{{ $type }} container--search"
        method="GET"
        action="{{ route('booking.search') }}">
        <div class="booking__form__field-wrapper">

            @foreach ($input_fields as $field)
                @php
                    $fieldName = $field['name'];
                    $fieldAttributes = [
                        'class' => 'booking__form__input',
                        'name' => $fieldName,
                        'type' => $field['type'],
                        'value' => Session::get($fieldName, $field['default']),
                        'min' => $field['min'],
                        'max' => $field['max'],
                        'required' => $type !== 'search',
                        'disabled' => $type == 'search',
                    ];
                @endphp

                <div class="booking__form__field">
                    <label class="booking__form__label"
                        for="{{ $fieldName }}">{{ $field['label'] }}</label>
                    <input {{ $attributes->merge($fieldAttributes) }}>
                </div>
            @endforeach

        </div>

        {{ $slot }}

    </form>
</section>
