<x-app-layout>
    <x-nav></x-nav>
    <x-step-bar :active=4>
        Booking Success!
    </x-step-bar>
    <section class="booking-success">
        <div class="booking-success__wrapper">
            <h2 class="booking-success__title">Reservation Details</h2>
            <ul class="booking-success__list">
                <li class="booking-success__item">
                    <label class="booking-success__label">Reservation ID:</label>
                    <span class="booking-success__value"> #{{ sprintf('%04d', $reservation->id) }}</span>
                </li>
                <li class="booking-success__item">
                    <label class="booking-success__label">Your Assigned Rooms:</label>
                    <span class="booking-success__value"> {{ join('', $reservation->rooms->pluck('room_number')->toArray()) }}</span>
                </li>

                <li class="booking-success__item">
                    <label class="booking-success__label">No. Of Guests:</label>
                    <span class="booking-success__value"> {{ $reservation->num_guests }}</span>
                </li>
                <li class="booking-success__item">
                    <label class="booking-success__label">Check In:</label>
                    <span class="booking-success__value"> {{ date('d/m/Y', strtotime($reservation->check_in_date)) }}</span>
                </li>
                <li class="booking-success__item">
                    <label class="booking-success__label">Check Out:</label>
                    <span class="booking-success__value">{{ date('d/m/Y', strtotime($reservation->check_out_date)) }}</span>
            </ul>
        </div>

    </section>
</x-app-layout>
