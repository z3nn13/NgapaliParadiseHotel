<div>
    <!---------- Navigation Starts ---------->
    <x-nav></x-nav>

    <!---------- Booking Heading Starts ---------->
    <section class="booking__heading container--landing">
        <div class="booking__titles">
            <h1 class="booking__title">Booking ID #{{ $reservation->formatted_id }}</h1>
            <h2 class="booking__subtitle">Dashboard > Bookings</h2>
        </div>
        <div class="booking__status booking__status--{{ strtolower($reservation->status) }}">
            {{ ucfirst($reservation->status) }}
        </div>
    </section>

    <!---------- Booking Card Starts ---------->
    <div class="booking__main container--landing">
        <section class="booking-card">
            <div class="booking-card__container">
                <h2 class="booking-card__title">Reservation Details</h2>

                @foreach ($reservation->rooms as $room)
                    @php
                        $roomPrice = $this->unit . ' ' . $this->getRoomPrice($room->pivot->roomDeal);
                    @endphp
                    <x-booking-card-room :isLastRoom="$loop->last == 1"
                        :roomType='$room->roomType'
                        :iteration='$loop->iteration'
                        :price='$roomPrice'
                        :roomDeal='$room->pivot->roomDeal' />
                @endforeach

                <x-booking-card-details :active='false'
                    :subTotal='$this->unit . $subTotal'
                    :coupon='$coupon'
                    :couponCode='$couponCode'
                    :totalAmount='$reservation->invoice->formatted_total' />
            </div>
        </section>



        <!---------- Billing Details Starts ---------->
        <section class="billing-details">
            <div class="billing-details__container">
                <h2 class="billing-details__title">
                    Billing Details
                </h2>
                <ul class="billing-details__list">
                    <x-billing-details-item value="{{ $reservation->first_name . ' ' . $reservation->last_name }}"
                        label="Guest name:" />
                    <x-billing-details-item value="{{ $reservation->email }}"
                        label="Email Address:" />
                    <x-billing-details-item value="{{ $reservation->phone_no }}"
                        label="Phone number:" />
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
    </div>
</div>
