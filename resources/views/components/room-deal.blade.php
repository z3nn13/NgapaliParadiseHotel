@props(['roomDeal'])
<div class="room-deal">
    <div class="room-deal__description">
        <p class="room-deal__title">{{ $roomDeal->deal_name }}</p>
        <p class="room-deal__price">MMK {{ $roomDeal->deal_mmk }}</p>
        <p class="room-deal__price--usd">EST USD {{ number_format((float) $roomDeal->deal_usd, 2, '.', '') }}</p>
    </div>
    <div class="room-deal__button-wrapper">
        <form method="GET" action="{{ route('booking.billing', ['id' => $roomDeal->id]) }}">
            @csrf
            <button type="submit" class="room-deal__button button button--primary">Reserve</button>
        </form>
    </div>
</div>
