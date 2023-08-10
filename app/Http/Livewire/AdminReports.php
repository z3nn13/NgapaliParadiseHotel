<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\ReportService;

class AdminReports extends Component
{
    public $selectedPeriod = 'today'; // Default period
    public $reportData;

    public function loadReportData()
    {
        $reportService = new ReportService();
        $this->reportData = $reportService->getReportData($this->selectedPeriod);
    }


    public function render()
    {
        $this->loadReportData();
        return view('livewire.admin-reports', [
            'reportData' => $this->reportData,
        ]);
    }
}
