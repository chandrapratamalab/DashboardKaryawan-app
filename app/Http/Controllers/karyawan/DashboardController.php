<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('karyawan.dashboard');
    }

    public function absensi()
    {
        return view('karyawan.absensi');
    }

    public function riwayat()
    {
        return view('karyawan.riwayat');
    }

    public function pengajuan()
    {
        return view('karyawan.pengajuan');
    }

    public function laporanKetidakhadiran()
{
    return view('Admin.laporan_ketidakhadiran', $data);
}
    public function profil()
    {
        return view('karyawan.profil');
    }

    public function notifikasi()
    {
        return view('karyawan.notifikasi');
    }
}