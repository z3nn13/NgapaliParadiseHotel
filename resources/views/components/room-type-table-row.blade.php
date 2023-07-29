@props(['roomType'])
<tr class="table__row">
    <td class="table__cell">
        #{{ sprintf('%03d', $roomType->id) }}
    </td>
    <td class="table__cell">
        <img class="table__image"
            src="{{ asset($roomType->room_image) }}">
    </td>
    <td class="table__cell">
        {!! str_replace('View', 'View<br>', $roomType->room_type_name) !!}
    </td>
    <td class="table__cell">
        {{ $roomType->view }}
    </td>
    <td class="table__cell">
        {{ $roomType->occupancy }}
    </td>
    <td class="table__cell">
        {{ $roomType->bedding }}
    </td>
    <td class="table__cell">
        {{ $roomType->description }}
    </td>




    {{-- <td class="table__cell">
        {!! join(',<br>', $roomType->rooms->pluck('room_number')->toArray()) !!}
    </td>
    <td class="table__cell">
        {!! join(',<br>', $roomType->room_deals->pluck('deal_name')->toArray()) !!}
    </td> --}}

    <!-- Actions Dropdown -->
    <x-table-action-dropdown>
        <!-- Dropdown Menu -->

        <!-- Mark As Option -->
        <button class="table__dropdown-option table__dropdown-option--mark"
            onclick="Livewire.emit('openModal', 'edit-room-type-modal', {{ json_encode(['roomType' => $roomType->id]) }})">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 48 48">
                <g fill="none"
                    stroke="currentColor"
                    stroke-linejoin="round"
                    stroke-width="4">
                    <path stroke-linecap="round"
                        d="M11 6v36" />
                    <path d="M11 9h14l7 3h7a2 2 0 0 1 2 2v17a2 2 0 0 1-2 2h-7l-7-3H11V9Z" />
                    <path stroke-linecap="round"
                        d="M7 42h8" />
                </g>
            </svg>
            Edit Room
        </button>

        <!-- Delete Option -->
        <button class="table__dropdown-option table__dropdown-option--delete"
            @click="confirmDeleteRoomType({{ $roomType->id }})">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24">
                <path fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="m14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            Delete

        </button>
    </x-table-action-dropdown>
</tr>
