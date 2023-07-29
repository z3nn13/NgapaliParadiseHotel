<!-- resources/views/bookings/booking_row.blade.php -->
@props(['booking'])

@php
    // Format Check In Date
    $check_in_date = date('jS M Y', strtotime($booking->check_in_date));
    
    // Format Paid
    $amount = 30;
    $currency = 'MMK';
    if ($booking->invoice) {
        $currency = $booking->invoice->preferred_currency;
        $amount = $currency === 'MMK' ? $booking->invoice->total_paid_mmk : $booking->invoice->total_paid_usd();
    }
    $paid = $currency . ' ' . $amount;
@endphp

<!-- Table row -->
<tr class="table__row">

    <!-- Booking ID -->
    <td class="table__cell">
        #{{ sprintf('%04d', $booking->id) }}
    </td>

    <!-- Guest Name -->
    <td class="table__cell">
        {{ $booking->first_name }}<br>
        {{ $booking->last_name }}
    </td>

    <!-- Check-in Date -->
    <td class="table__cell table__cell--bolded table__cell--accent">
        {{ $check_in_date }}
    </td>

    <!-- Paid Amount -->
    <td class="table__cell">
        {{ $paid }}<span>.00</span>
    </td>

    <!-- Booking Status -->
    <td class="table__cell">
        <span class="booking__status booking__status--{{ strtolower($booking->status) }}">
            {{ ucfirst($booking->status) }}
        </span>
    </td>

    <!-- Actions Dropdown -->
    <x-table-action-dropdown>
        <!-- Dropdown Menu -->

        <!-- Mark As Option -->
        <button class="table__dropdown-option table__dropdown-option--mark" @click.stop>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                    <path stroke-linecap="round" d="M11 6v36" />
                    <path d="M11 9h14l7 3h7a2 2 0 0 1 2 2v17a2 2 0 0 1-2 2h-7l-7-3H11V9Z" />
                    <path stroke-linecap="round" d="M7 42h8" />
                </g>
            </svg>
            Mark As
        </button>

        <!-- View Option -->
        <form action="{{ route('admin.reservations.show', ['reservation' => $booking->id]) }}">
            <button class="table__dropdown-option table__dropdown-option--view" type="submit" @click.stop>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                        <path
                              d="M3.275 15.296C2.425 14.192 2 13.639 2 12c0-1.64.425-2.191 1.275-3.296C4.972 6.5 7.818 4 12 4c4.182 0 7.028 2.5 8.725 4.704C21.575 9.81 22 10.361 22 12c0 1.64-.425 2.191-1.275 3.296C19.028 17.5 16.182 20 12 20c-4.182 0-7.028-2.5-8.725-4.704Z" />
                        <path d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0Z" />
                    </g>
                </svg>
                View
            </button>
        </form>

        <!-- Delete Option -->
        <button class="table__dropdown-option table__dropdown-option--delete" @click.stop="confirmDeleteBooking({{ $booking->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="m14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            Delete
        </button>

    </x-table-action-dropdown>
</tr>
