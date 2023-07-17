<x-app-layout>
    <x-nav></x-nav>
    <x-step-bar :active=3></x-step-bar>
    <div class="confirmation-page">
        @php
            $roomType = session('roomChoice');
            $roomDeal = session('dealChoice');
            $numNights = session('numNights');
            $numGuest = session('numGuests');
            $unit = $billingData['currency'] == 'USD' ? "$" : 'MMK';
        @endphp
        <div class="invoice">
            <div class="invoice__container">

                <h2 class="confirmation-page__title">Billing Info</h2>
                <div class="invoice__item">
                    <span class="invoice__label">Room 1:</span>
                    <span class="invoice__value">{{ $roomType->room_type_name }}</span>
                </div>
                <div class="invoice__item">
                    <span class="invoice__label">Room Deal:</span>
                    <span class="invoice__value">{{ $roomDeal->deal_name }}</span>
                </div>
                <div class="invoice__item">
                    <span class="invoice__label">Number of Nights:</span>
                    <span class="invoice__value">{{ $numNights }}</span>
                </div>
                <div class="invoice__item">
                    <span class="invoice__label">Payment Method:</span>
                    <span class="invoice__value">$ {{ $billingData['payment_method'] }}</span>
                </div>
                <div class="invoice__item">
                    <span class="invoice__label">Total Amount:</span>
                    <span class="invoice__value">$ {{ $billingData['totalAmount'] }}</span>
                </div>
            </div>
        </div>

        <div class="confirmation-page__buttons">
            <form action="{{ route('booking.create') }}" method="post">
                @csrf
                <input type="hidden" name="goBack" value="true">
                <button type="submit" class="confirmation-page__button button button--secondary">Go
                    Back</button>
            </form>
            <form action="{{ route('booking.payment') }}" method="post">
                @csrf
                <input type="hidden" name="currency" value="{{ $billingData['currency'] }}">
                <input type="hidden" name="totalAmount" value="{{ $billingData['totalAmount'] }}">
                <button type="submit" class="confirmation-page__button button button--primary">Send Payment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
