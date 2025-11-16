<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenceReportController extends Controller
{
    public function index()
    {
        // Data sederhana untuk testing
        $data = [
            'title' => 'Laporan Ketidakhadiran',
            'absences' => [
                ['name' => 'John Doe', 'date' => '2024-03-15', 'type' => 'sakit'],
                ['name' => 'Jane Smith', 'date' => '2024-03-14', 'type' => 'izin'],
            ]
        ];

        return view('Admin.laporan_ketidakhadiran', $data);
    }
}