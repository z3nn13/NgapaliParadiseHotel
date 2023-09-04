@props(['isLastRoom', 'roomType', 'roomDeal', 'price', 'iteration', 'room', 'active' => false])

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
            <svg class="booking-card__room-icon"
                xmlns="http://www.w3.org/2000/svg"
                width="256"
                height="256"
                viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M17 9.17a1 1 0 0 0-1.41 0L12 12.71L8.46 9.17a1 1 0 0 0-1.41 0a1 1 0 0 0 0 1.42l4.24 4.24a1 1 0 0 0 1.42 0L17 10.59a1 1 0 0 0 0-1.42Z" />
            </svg>
        </button>
        @if ($active)
            <button class="booking-card__room-button
                        booking-card__room-button--delete"
                wire:click='confirmDeleteRoom({{ json_encode($room) }})'>
                <svg class="booking-card__room-icon"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24">
                    <path fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M6 12h12" />
                </svg>
            </button>
        @endif
    </div>
</li>
