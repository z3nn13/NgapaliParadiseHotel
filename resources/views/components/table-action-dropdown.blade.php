<td class="table__cell table__cell--action">

    <!-- Actions Button -->
    <div class="table__dropdown">
        <x-dropdown>
            <x-slot name="trigger">
                <img class="table__dropdown-trigger"
                    src="{{ asset('images/svgs/action.svg') }}"
                    :class="{ 'table__dropdown-trigger--active': dropdown }">
            </x-slot>

            <div class="table__dropdown-container"
                :class="dropdownPosition"
                x-cloak
                x-ref="container">
                {{ $slot }}
            </div>
        </x-dropdown>
    </div>
</td>
