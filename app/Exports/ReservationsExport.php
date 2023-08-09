<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    private $reservationIds;

    public function __construct($reservationIds)
    {
        $this->reservationIds = $reservationIds;
    }

    public function headings(): array
    {
        return
            [
                'ID #',
                'Name',
                'Check In',
                'Paid',
                'Status',
            ];
    }

    public function map($reservation): array
    {
        $currency = $reservation->invoice->preferred_currency;
        $amount = $currency === 'MMK' ? $reservation->invoice->total_paid_mmk : $reservation->invoice->total_paid_usd();
        $paid = $currency . ' ' . $amount;

        return
            [
                '#' . sprintf('%03d', $reservation->id),
                $reservation->first_name . " " . $reservation->last_name,
                $reservation->check_in_date,
                $paid,
                $reservation->status,
            ];
    }

    /** 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reservation::find($this->reservationIds);
    }
}
