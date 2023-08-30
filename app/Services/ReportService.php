<?php


namespace App\Services;

use App\Models\Room;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Reservation;

class ReportService
{
    /**
     * Generate report information for dashboard
     *
     * @param string $selectedPeriod
     * @return void
     */
    public function getReportData($selectedPeriod)
    {
        [$startDate, $endDate] = $this->getDateRangeForPeriod($selectedPeriod);

        $reportData = [
            'totalRevenue' => $this->getTotalRevenue($startDate, $endDate),
            'totalBookings' => $this->getTotalBookings($startDate, $endDate),
            'totalRoomsBooked' => $this->getTotalRoomsBooked($startDate, $endDate),
            'totalUsers' => $this->getTotalUsers($startDate, $endDate),
        ];

        return $reportData;
    }

    protected function getDateRangeForPeriod($selectedPeriod)
    {
        $periodMappings = [
            'monthly' => ['startOfMonth', 'endOfMonth'],
            'yearly' => ['startOfYear', 'endOfYear'],
            'weekly' => ['startOfWeek', 'endOfWeek'],
        ];

        if (array_key_exists($selectedPeriod, $periodMappings)) {
            [$startMethod, $endMethod] = $periodMappings[$selectedPeriod];
            $startDate = now()->$startMethod();
            $endDate = now()->$endMethod();
        } else {
            $startDate = now()->startOfDay();
            $endDate = now()->endOfDay();
        }

        return [$startDate, $endDate];
    }

    protected function getTotalRevenue($startDate, $endDate)
    {
        return Invoice::whereBetween('created_at', [$startDate, $endDate])->sum('total_paid_mmk');
    }

    protected function getTotalBookings($startDate, $endDate)
    {
        return Reservation::whereBetween('created_at', [$startDate, $endDate])->count();
    }

    protected function getTotalRoomsBooked($startDate, $endDate)
    {
        return Room::whereHas('reservations', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('reservations.created_at', [$startDate, $endDate]);
        })->count();
    }

    protected function getTotalUsers($startDate, $endDate)
    {
        return User::whereBetween('created_at', [$startDate, $endDate])->count();
    }
}
