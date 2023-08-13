@props(['roomType', 'reversed' => false])
<div @class(['room-card', 'room-card--reversed' => $reversed])>
    <div class="room-card__image-wrapper">
        <img class="room-card__image"
            src="{{ asset($roomType->room_image) }}"
            alt="">
    </div>
    <div class="room-card__content">
        <h2 class="room-card__title">{{ $roomType->room_type_name }}</h2>
        <p class="room-card__text">{{ $roomType->description }}</p>

        <div class="room-card__stats">
            <div class="room-card__stat">
                <img src="{{ asset('images/svgs/iconoir-user.svg') }}"
                    alt="">
                <p>{{ $roomType->occupancy }} Capacity</p>
            </div>
            <div class="room-card__stat">
                <img src="{{ asset('images/svgs/la-bed.svg') }}"
                    alt="">
                <p>{{ $roomType->bedding }}</p>
            </div>
        </div>
        <footer class="room-card__footer">
            <a class="room-card__cta room-card__cta--primary"
                href="{{ route('index') }}">Book Now</a>
            <a class="room-card__cta room-card__cta--secondary"
                href="{{ route('index') }}">Learn More...</a>
        </footer>
    </div>
</div>
