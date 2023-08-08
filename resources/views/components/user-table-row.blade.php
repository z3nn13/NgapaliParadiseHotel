<!-- resources/views/components/user-table-row.blade.php -->
@props(['user'])

<tr>
    <!-- Checkbox -->
    <td class="table__cell">
        <input class="table__checkbox"
            type="checkbox"
            wire:model='selectedModels.{{ $user->id }}'
            {!! $attributes->wire('model')->value ? 'checked' : '' !!}>
    </td>

    <!-- User ID -->
    <td class="table__cell">
        #{{ sprintf('%04d', $user->id) }}
    </td>
    <!-- Full Name -->
    <td class="table__cell">
        {{ $user->first_name }}<br>{{ $user->last_name }}
    </td>
    <!-- User Role -->
    <td class="table__cell">
        {{ ucfirst($user->role->name) }}
    </td>
    <!-- Email -->
    <td class="table__cell">
        {{ $user->email }}
    </td>
    <!-- Phone Number -->
    <td class="table__cell">
        {{ $user->phone_no }}
    </td>

    <!-- Actions Dropdown -->
    <x-table-action-dropdown>
        <!-- Dropdown Menu -->

        <!-- Mark As Option -->
        <button class="table__dropdown-option table__dropdown-option--mark"
            onclick="Livewire.emit('openModal', 'edit-user-modal', {{ json_encode(['user' => $user->id]) }})">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24">
                <g fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2">
                    <path d="m16.474 5.408l2.118 2.117m-.756-3.982L12.109 9.27a2.118 2.118 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621Z" />
                    <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
                </g>
            </svg>
            Edit
        </button>

        <!-- Delete Option -->
        <button class="table__dropdown-option table__dropdown-option--delete"
            onclick="confirmDelete('User', @json([$user->id]))">
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
