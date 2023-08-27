<div>
    <x-nav type="primary" />
    <x-step-bar active="2" />


    <div class="container__booking--create">
        <div class="green__background"></div>

        <div class="billing-grid billing-grid--create">
            <div class="billing-summary">
                <h2 class="booking-card__title">Reservation Details</h2>
                <ul>
                    @foreach ($reservationRooms as $room)
                        @php
                            $roomType = $room['room']->roomType;
                            $roomDeal = $room['roomDeal'];
                            $roomPrice = $this->unit . ' ' . $this->getRoomPrice($roomDeal);
                        @endphp

                        <x-booking-card-room :isLastRoom="$loop->last"
                            :roomType='$roomType'
                            :iteration='$loop->iteration'
                            :price='$roomPrice'
                            :roomDeal='$roomDeal' />
                    @endforeach
                </ul>

                @php
                    $subTotal = $this->unit . ' ' . $subTotal;
                    $totalAmount = $this->unit . ' ' . $totalAmount;
                @endphp

                <x-booking-card-details :active='true'
                    :subTotal='$subTotal'
                    :totalAmount='$subTotal'
                    :coupon='$coupon'
                    :couponCode='$couponCode' />
            </div>
            @livewire('billing-form')
        </div>
    </div>
</div>
