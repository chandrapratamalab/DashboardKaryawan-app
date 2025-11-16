<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('karyawan.profil', compact('user'));
    }

    public function update(Request $request)
    {
        // Logic untuk update profil
        return redirect()->route('karyawan.profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function uploadFoto(Request $request)
    {
        // Logic untuk upload foto
        return redirect()->route('karyawan.profil')->with('success', 'Foto profil berhasil diupload');
    }

    public function gantiPassword(Request $request)
    {
        // Logic untuk ganti password
        return redirect()->route('karyawan.profil')->with('success', 'Password berhasil diubah');
    }
}