<div>
    <x-nav type="primary" />
    <x-step-bar active="2" />


    <div class="container__booking--create">
        <div class="green__background"></div>

        <div class="billing-grid billing-grid--create">
            <div class="billing-summary">
                <h2 class="billing-summary__title">Billing Summary</h2>

                <ul>
                    @foreach ($reservationRooms as $room)
                        @php
                            $roomType = $room['roomType'];
                            $roomDeal = $room['roomDeal'];
                            $roomPrice = $unit . ' ' . $this->getRoomPrice($roomDeal);
                        @endphp

                        <x-room-summary :roomType="$roomType"
                            :roomDeal="$roomDeal"
                            :iteration="$loop->iteration"
                            :isLastRoom="$loop->last"
                            :roomPrice="$roomPrice" />
                    @endforeach
                </ul>
                @php
                    $subTotal = $unit . ' ' . $subTotal;
                    $totalAmount = $unit . ' ' . $totalAmount;
                @endphp
                <x-summary-details :numNights="session('booking.numNights')"
                    :numGuests="session('booking.numGuests')"
                    :subTotal="$subTotal"
                    :couponCode="$couponCode"
                    :totalAmount="$totalAmount" />
            </div>

            @livewire('billing-form')
        </div>
    </div>
</div>
