<section class="rooms">
    @livewire('category-select')
    @foreach ($roomTypes as $index => $roomType)
        <!-- Reverse Card For Even Rooms-->
        @if ($index % 2)
            <x-room-card :roomType=$roomType :reversed=true></x-room-card>
        @else
            <x-room-card :roomType=$roomType></x-room-card>
        @endif
    @endforeach
</section>
