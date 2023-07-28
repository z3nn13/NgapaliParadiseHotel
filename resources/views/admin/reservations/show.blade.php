<x-admin-layout active="Dashboard">
    Section
    <h1> Booking Details </h1>
    {{ $reservation }}

    <h2>
        Guest Details
        {{ $reservation->first_name }}
        {{ $reservation->last_name }}
        {{ $reservation->email }}
        {{ $reservation->phone_no }}
        {{ $reservation->country }}
    </h2>

    <h2>
        Invoice Details
    </h2>
</x-admin-layout>
