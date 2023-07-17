@props(['roomType'])
<div class="room-result container--search">
    <h2 class="room-result__title">"{{ $roomType->room_type_name }}"</h2>
    <div class="room-result__container container--search">
        <p class="room-result__available-rooms">
            {{ $roomType->available_rooms }} Rooms Left
        </p>
        <div class="room-result__card">
            <img src="{{ asset($roomType->room_image) }}" class="room-result__card-image">
            <div class="room-result__card-body">
                <ul class="room-result__tags">
                    <li class="room-result__tag">
                        <label class="room-result__tag-label">Occupancy:</label>
                        <p class="room-result__tag-value">Sleeps {{ $roomType->occupancy }}</p>
                    </li>
                    <li class="room-result__tag">
                        <label class="room-result__tag-label">Bedding</label>
                        <p class="room-result__tag-value">{{ $roomType->bedding }}</p>
                    </li>
                    <li class="room-result__tag">
                        <label class="room-result__tag-label">View</label>
                        <p class="room-result__tag-value">{{ $roomType->view }}</p>
                    </li>
                    <li class="room-result__tag">
                        <label class="room-result__tag-label">Wifi</label>
                        <p class="room-result__tag-value">Free</p>
                    </li>
                </ul>
                <a class="room-result__link" href="/room/1">
                    + See More Details
                </a>
            </div>

        </div>
        <hr class="room-result__separator">
        <div class="room-result__deals">
            <h3 class="room-result__deals-title">Choose a deal from below</h3>
            @foreach ($roomType->room_deals as $roomDeal)
                <form action="{{ route('booking.create') }}" method="post">
                    @csrf
                    <input type="hidden" name="roomTypeID" value="{{ $roomType->id }}">
                    <x-room-deal :roomDeal=$roomDeal></x-room-deal>
                </form>
            @endforeach
        </div>
    </div>
</div>
