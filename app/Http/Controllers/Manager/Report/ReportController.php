<?php

namespace App\Http\Controllers\Manager\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected $reportService;
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function showTransaction()
    {
        $transactions = $this->reportService->getAll();
        //dd($transactions);
        return view('manager.report.transaction',compact('transactions'));
    }

    public function showFin()
    {
        return view('manager.report.fin');
    }
}
