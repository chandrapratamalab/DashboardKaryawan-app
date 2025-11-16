<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanAbsensiController extends Controller
{
    public function index()
    {
        return view('Admin.laporan_absensi'); // untuk menu laporan
    }
    
    public function generateReport(Request $request)
    {
        // logic untuk laporan
    }
}