<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function ketidakhadiran()
    {
        return view('hrd.laporan_ketidakhadiran', [
            'pageTitle' => 'Laporan Ketidakhadiran'
        ]);
    }

    public function shift()
    {
        return view('hrd.laporan_shift', [
            'pageTitle' => 'Laporan Shift'
        ]);
    }

    public function absensi()
    {
        return view('hrd.laporan_absensi', [
            'pageTitle' => 'Laporan Absensi'
        ]);
    }
}