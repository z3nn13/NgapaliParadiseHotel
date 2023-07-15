<x-app-layout>
    <x-nav></x-nav>
    <x-step-bar :active=3></x-step-bar>
    <div class="confirmation-page">
        <h2 class="confirmation-page__title">Invoice</h2>
        @php
            $roomType = session('roomChoice');
            $roomDeal = session('roomDeal');
            $checkIn = \Carbon\Carbon::parse(session('checkInDate'));
            $checkOut = \Carbon\Carbon::parse(session('checkOutDate'));
            $numNights = $checkIn->diffInDays($checkOut);
            $numGuest = session('numGuests');
            $totalAmount = $roomDeal->deal_mmk * $numNights;
        @endphp
        <div class="invoice">
            <div class="invoice__item">
                <span class="invoice__label">Room Type:</span>
                <span class="invoice__value">{{ $roomType }}</span>
            </div>
            <div class="invoice__item">
                <span class="invoice__label">Deal Choice:</span>
                <span class="invoice__value">{{ $roomDeal }}</span>
            </div>
            <div class="invoice__item">
                <span class="invoice__label">Number of Nights:</span>
                <span class="invoice__value">{{ $numNights }}</span>
            </div>
            <div class="invoice__item">
                <span class="invoice__label">Total Amount:</span>
                <span class="invoice__value">{{ $totalAmount }}</span>
            </div>
        </div>

        <div class="confirmation-page__buttons">
            <form action="{{ route('booking.create') }}" method="post">
                @csrf
                <input type="hidden" name="goBack" value="true">
                <button type="submit" class="confirmation-page__button confirmation-page__button--back">Go
                    Back</button>
            </form>
            <form action="{{ route('booking.payment') }}" method="post">
                @csrf
                <button type="submit" class="confirmation-page__button confirmation-page__button--payment">Send Payment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
