<x-app-layout>
    <x-nav></x-nav>
    <x-step-bar :active=4>
        Booking Success!
    </x-step-bar>
    <section class="booking-success">
        <div class="booking-success__wrapper">
            <h2 class="booking-success__title">Reservation Details</h2>
            <h2>
                Reservation ID: #{{ $reservationData->id }}
            </h2>
            <h2>
                Your Rooms
            </h2>
            @foreach ($reservationData->rooms as $room)
                <p>
                    Room Type: {{ $room->room_type->room_type_name }}
                </p>
                <img src="{{ asset($room->room_type->room_image) }}"
                    alt=""
                    width=160px>
                <p>
                    Room Number: {{ $room->room_number }}
                </p>
            @endforeach
        </div>

    </section>
</x-app-layout>
