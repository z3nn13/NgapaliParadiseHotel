<li class="booking-card__room"
    x-data="{ open: {{ $isLastRoom ? 'true' : 'false' }} }">

    <div class="booking-card__room-body">
        <img class="booking-card__room-image"
            src="{{ asset($roomType->room_image) }}"
            alt="Room Image"
            x-transition
            x-show="open">
        <div class="booking-card__room-content"
            x-transition
            :class="{ 'booking-card__room-content--closed': !open }">
            <div class="booking-card__room-desc">
                <p class="booking-card__text booking-card__text--tinted">Room {{ $iteration }}:</p>
                <p class="booking-card__text booking-card__text--name booking-card__text--bright"
                    :class="{ 'booking-card__text--closed': !open }">{{ $roomType->room_type_name }}</p>
            </div>
            <p class="booking-card__room-price">
                {{ $price }}
            </p>
        </div>
        <p class="booking-card__text booking-card__text--expanded booking-card__text--tinted"
            x-transition
            x-show="open">Room Deal: <span class="booking-card__text--bright">{{ $roomDeal->deal_name }}</span></p>
        {{-- <p>Room Deal: {{ $roomDeal->deal_name }}</p> --}}
    </div>

    <div class="booking-card__room-buttons">
        <button class="booking-card__room-button 
                        booking-card__room-button--trigger"
            @click="open = !open"
            x-transition
            :class="{ 'booking-card__room-button--trigger-active': open }">
            <img class="icon__angle-down"
                src="{{ asset('/images/svg/angle-down.svg') }}">
        </button>
        <button class="booking-card__room-button
                        booking-card__room-button--delete">
        </button>
    </div>
</li>
