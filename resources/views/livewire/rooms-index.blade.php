<section class="rooms">
    @livewire('category-select')
    @foreach ($roomTypes as $roomType)
        <!-- Reverse Card For Even Rooms-->
        @if ($loop->odd)
            <x-room-card :roomType=$roomType></x-room-card>
        @else
            <x-room-card :roomType=$roomType
                :reversed=true></x-room-card>
        @endif
    @endforeach
</section>
