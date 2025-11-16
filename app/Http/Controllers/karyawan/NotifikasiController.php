<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        return view('karyawan.notifikasi');
    }

    public function show($id)
    {
        return view('karyawan.notifikasi-show');
    }

    public function markAllRead(Request $request)
    {
        // Logic untuk menandai semua notifikasi sebagai sudah dibaca
        return redirect()->route('karyawan.notifikasi')->with('success', 'Semua notifikasi ditandai sudah dibaca');
    }

    public function destroy($id)
    {
        // Logic untuk menghapus notifikasi
        return redirect()->route('karyawan.notifikasi')->with('success', 'Notifikasi berhasil dihapus');
    }
}