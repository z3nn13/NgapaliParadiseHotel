<?php


namespace App\Services;

use App\Models\Room;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Reservation;

class ReportService
{
    public function getReportData($selectedPeriod)
    {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();

        if ($selectedPeriod === 'monthly') {
            $startDate->startOfMonth();
            $endDate->endOfMonth();
        } elseif ($selectedPeriod === 'yearly') {
            $startDate->startOfYear();
            $endDate->endOfYear();
        }

        return [
            'totalRevenue' => Invoice::whereBetween('created_at', [$startDate, $endDate])->sum('total_paid_mmk'),
            'totalBookings' => Reservation::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalRoomsBooked' => Room::whereBetween('created_at', [$startDate, $endDate])->count(),
            'totalUsers' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
        ];
    }
}
