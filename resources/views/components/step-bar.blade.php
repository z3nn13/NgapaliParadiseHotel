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
        @php
            $isCompleted = $counter < $active;
            $isActive = $counter == $active;
        @endphp
        <div @class([
            'step-bar__item',
            'step-bar__item--completed' => $isCompleted,
            'step-bar__item--active' => $isActive,
        ])>
            <div class="step-bar__circle">
                @if ($isCompleted)
                    <i class="fa-solid fa-check"></i>
                @else
                    0{{ $counter }}
                @endif
            </div>
            <div class="step-bar__name">{{ $name }}</div>
        </div>
    @endforeach
</section>
