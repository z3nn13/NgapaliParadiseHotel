<!-- Closed -->
<svg @click="is_open = !is_open"
    {{ $attributes->merge(['class' => 'hamburger']) }}
    x-show="!is_open"
    width="30"
    height="29"
    viewBox="0 0 30 29"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <line y1="7.5"
        x2="30"
        y2="7.5"
        stroke="#62382B"
        stroke-width="3" />
    <line y1="17.5"
        x2="30"
        y2="17.5"
        stroke="#62382B"
        stroke-width="3" />
    <line y1="27.5"
        x2="30"
        y2="27.5"
        stroke="#62382B"
        stroke-width="3" />
</svg>

<!-- Open -->
<svg x-show="is_open"
    @click="is_open = !is_open"
    {{ $attributes->merge(['class' => 'hamburger']) }}
    width="30"
    height="29"
    viewBox="0 0 30 29"
    fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <line y1="7.5"
        x2="20"
        y2="7.5"
        stroke="#62382B"
        stroke-width="3" />
    <line x1="1.31134e-07"
        y1="17.5"
        x2="25"
        y2="17.5"
        stroke="#62382B"
        stroke-width="3" />
    <line y1="27.5"
        x2="30"
        y2="27.5"
        stroke="#62382B"
        stroke-width="3" />
</svg>
