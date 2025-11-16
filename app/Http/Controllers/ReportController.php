<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function shiftReport()
    {
        return view('Admin.laporan_shift');
    }

    public function exportShiftPDF()
    {
        // Logic untuk export PDF
    }

    public function exportShiftExcel()
    {
        // Logic untuk export Excel
    }
}