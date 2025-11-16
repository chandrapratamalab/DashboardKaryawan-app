<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        return view('karyawan.pengajuan');
    }

    public function create()
    {
        return view('karyawan.pengajuan-create');
    }

    public function store(Request $request)
    {
        // Logic untuk menyimpan pengajuan
        return redirect()->route('karyawan.pengajuan')->with('success', 'Pengajuan berhasil dikirim');
    }

    public function show($id)
    {
        return view('karyawan.pengajuan-show');
    }

    public function destroy($id)
    {
        // Logic untuk menghapus pengajuan
        return redirect()->route('karyawan.pengajuan')->with('success', 'Pengajuan berhasil dihapus');
    }
}