@props(['reservation', 'rowClass' => ''])

@php
    // Format Check In Date
    $check_in_date = date('jS M Y', strtotime($reservation->check_in_date));
    
    $currency = $reservation->invoice->preferred_currency;
    $amount = $currency === 'MMK' ? $reservation->invoice->total_paid_mmk : $reservation->invoice->total_paid_usd();
    $paid = $currency . ' ' . $amount;
@endphp

<!-- Table row -->
<tr class="table__row {{ $rowClass }}">

    <!-- Checkbox -->
    <td class="table__cell">
        {{ $reservation->created_at->diffForHumans() }}
    </td>

    <!-- Reservation ID -->
    <td class="table__cell">
        #{{ sprintf('%04d', $reservation->id) }}
    </td>

    <!-- Check-in Date -->
    <td class="table__cell table__cell--bolded table__cell--accent">
        {{ $check_in_date }}
    </td>

    <!-- Paid Amount -->
    <td class="table__cell">
        {{ $paid }}<span>.00</span>
    </td>

    <!-- reservation Status -->
    <td class="table__cell">
        <span class="booking__status booking__status--{{ strtolower($reservation->status) }}">
            {{ ucfirst($reservation->status) }}
        </span>
    </td>

    <!-- Actions Dropdown -->
    <td class="table__cell table__cell--action">

        <!-- View Option -->
        <a class="table__dropdown-option table__dropdown-option--view"
            type="submit"
            href="{{ route('dashboard.bookings.show', ['reservation' => $reservation->id]) }}">
            View
        </a>
        </form>
    </td>
</tr>
