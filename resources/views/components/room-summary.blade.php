<li class="billing-summary__room-detail"
    x-data="{ open: {{ $isLastRoom ? 'true' : 'false' }} }">
    <div class="billing-summary__room-grid">
        <img class="billing-summary__room-image billing-summary__room-grid--left"
            src="{{ asset($roomType->room_image) }}"
            alt="Room-Image"
            x-transition.scale.origin.top
            x-show="open">

        <div class="billing-summary__room-heading">
            <div class="billing-summary__room-heading--left">
                <p class="billing-summary__room-index text-sun-400">Room {{ $iteration }}</p>
                <p class="billing-summary__room-name">{{ $roomType->room_type_name }}</p>
            </div>
        </div>
        <p class="billing-summary__room-price">{{ $roomPrice }}</p>

        <button class="billing-summary__room-heading--right billing-summary__dropdown-trigger"
            @click="open = !open"
            :class="{ 'billing-summary__dropdown-trigger--active': open }">
            <img class="icon__angle-down"
                src="/images/svg/angle-down.svg">
        </button>

    </div>

    <div class="billing-summary__room-body"
        x-show="open"
        x-transition.scale.origin.top>
        <p class="billing-summary__room-deal">
            <span class="text-sun-400">Room Deal:</span> {{ $roomDeal->deal_name }}
        </p>
    </div>
</li>
