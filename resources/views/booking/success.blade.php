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
                    <span class="booking-success__value"> #{{ $reservation->formatted_id }}</span>
                </li>
                <li class="booking-success__item">
                    <label class="booking-success__label">Your Assigned Rooms:</label>
                    <span class="booking-success__value"> {{ join(',', $reservation->rooms->pluck('room_number')->toArray()) }}</span>
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

            <div class="booking-success__footer">
                <div class="booking-success__footer-text">
                    <p class="booking-success__text">Thank you for booking with us.</p>
                    <p class="booking-success__text">If you have anymore inquiries, please contact us at:</p>
                    <a class="booking-success__link"
                        href="tel:+959511663">(+95) 951-1663</a>
                </div>
                <a class="button button--primary"
                    href="{{ route('index') }}">Go to home</a>
            </div>
        </div>

    </section>
</x-app-layout>
