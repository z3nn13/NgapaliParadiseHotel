<section class="rooms">
    @livewire('category-select')
    @forelse ($roomTypes as $roomType)
        <!-- Reverse Card For Even Rooms-->
        @if ($loop->odd)
            <x-room-card :roomType=$roomType></x-room-card>
        @else
            <x-room-card :roomType=$roomType :reversed=true></x-room-card>
        @endif
    @empty
        <p>No Rooms Found.<br> If you are a developer please run php artisan migrate --seed</p>
    @endforelse
</section>
