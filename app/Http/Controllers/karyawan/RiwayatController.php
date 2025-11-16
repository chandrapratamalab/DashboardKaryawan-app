<?php
namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RiwayatController extends Controller  // Hapus _kehadiran
{
    public function index()
    {
        return view('karyawan.riwayat_kehadiran');
    }
}