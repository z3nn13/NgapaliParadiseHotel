@props(['active'])

@php
    $stepBarItems = [
        1 => 'Search Results',
        2 => 'Billing',
        3 => 'Confirmation',
    ];
@endphp

<h1 class="step-bar__title">Booking Progress</h1>
<section class="step-bar container--search">
    @foreach ($stepBarItems as $counter => $name)
        <div @class([
            'step-bar__item',
            'step-bar__item--completed' => $active > $counter,
            'step-bar__item--active' => $active == $counter,
        ])>
            <div class="step-bar__circle">0{{ $counter }}</div>
            <div class="step-bar__name">{{ $name }}</div>
        </div>
    @endforeach
</section>
