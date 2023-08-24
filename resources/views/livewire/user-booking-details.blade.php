<div>
    <x-nav></x-nav>
    <section class="booking__heading container--landing">
        <div class="booking__titles">
            <h1 class="booking__title">Booking ID #{{ sprintf('%04d', $reservation->id) }}</h1>
            <h2 class="booking__subtitle">Dashboard > Bookings</h2>
        </div>
        <div class="booking__status booking__status--{{ strtolower($reservation->status) }}">
            {{ $reservation->status }}
        </div>
    </section>

    <section class="booking__main container--landing">
        <section class="booking-details">
            <div class="billing-grid">
                <div class="billing-summary">
                    <h2 class="billing-summary__title">Reservation Details</h2>
                    <ul>
                        @php
                            $roomDeal = $reservation->roomDeals;
                        @endphp
                        @foreach ($reservation->rooms as $room)
                            <x-room-summary :roomType="$room->roomType"
                                :roomDeal="$roomDeal->slice($loop->index, 1)->first()"
                                :iteration="$loop->iteration"
                                :isLastRoom="$loop->last"
                                :roomPrice="20" />
                        @endforeach
                    </ul>
                    <x-summary-details :numNights="session('booking.numNights')"
                        :numGuests="session('booking.numGuests')"
                        :subTotal="200"
                        :couponCode="isset($reservation->invoice->coupon) ? $reservation->invoice->coupon->coupon_code : null"
                        :totalAmount="$reservation->invoice->total_paid_mmk" />
                </div>
            </div>
        </section>

        <section class="billing-details">
            <div class="billing-details__container">
                <h2 class="billing-details__title">
                    Billing Details
                </h2>
                <ul class="billing-details__list">
                    <x-billing-details-item value="{{ $reservation->first_name . ' ' . $reservation->last_name }}"
                        label="Guest name:" />
                    <x-billing-details-item value="{{ $reservation->phone_no }}"
                        label="Phone number:" />
                    <x-billing-details-item value="{{ $reservation->email }}"
                        label="Email:" />
                    <x-billing-details-item value="{{ $reservation->country }}"
                        label="Country:" />
                    <x-billing-details-item value="{{ $reservation->invoice->preferred_currency }}"
                        label="Preferred currency:" />
                    <x-billing-details-item value="{{ date('d/m/Y', strtotime($reservation->invoice->created_at)) }}"
                        label="Payment date:" />
                </ul>
            </div>

            <div class="billing-details__buttons">
                <button class="billing-details__button"
                    wire:click="confirmCancel()"
                    {{ strtolower($reservation->status) == 'upcoming' ? '' : 'disabled' }}>
                    Cancel
                    Booking
                </button>
                <span class="billing-details__button-text">Warning: Cancellation fees are applicable</span>
            </div>
        </section>
    </section>
</div>
