<!-- resources/views/components/user-table-row.blade.php -->
@props(['user'])

<tr>
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
    <td
        class="table__cell table__cell--action"
        x-data="{ dropdown: false }"
    >

        <!-- Actions Button -->
        <div
            class="table__actions"
            @click="dropdown = !dropdown"
            @click.away="dropdown = false"
            x-transition.duration.500ms
        >
            <img
                src="{{ asset('images/svgs/action.svg') }}"
                :class="dropdown && 'table__actions--active'"
            >
        </div>

    </td>
</tr>
