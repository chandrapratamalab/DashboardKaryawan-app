<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanShiftController extends Controller
{
    public function index()
    {
        // Data sample
        $data = [
            'title' => 'Laporan Shift Karyawan',
            'shifts' => [
                ['id' => 1, 'nama' => 'John Doe', 'departemen' => 'IT', 'shift' => 'Pagi', 'tanggal' => '2024-01-15'],
                ['id' => 2, 'nama' => 'Jane Smith', 'departemen' => 'HRD', 'shift' => 'Siang', 'tanggal' => '2024-01-15'],
            ]
        ];

        return view('Admin.laporan_shift', $data);
    }
}