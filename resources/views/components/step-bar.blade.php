@props(['active'])

@php
    $stepBarItems = [
        1 => 'Search Results',
        2 => 'Billing',
        3 => 'Confirmation',
    ];
@endphp

<h1 class="step-bar__title">
    @if ($active == 4)
        {{ $slot }}
    @else
        Booking Progress
    @endif
</h1>

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
                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none">
                        <path d="M9.00004 20.42L2.79004 14.21L5.62004 11.38L9.00004 14.77L18.88 4.88L21.71 7.71L9.00004 20.42Z"
                            fill="#478971" />
                    </svg>
                @else
                    0{{ $counter }}
                @endif
            </div>
            <div class="step-bar__name">{{ $name }}</div>
        </div>
    @endforeach
</section>
