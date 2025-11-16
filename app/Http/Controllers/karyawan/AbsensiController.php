<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // Data sample karyawan
        $karyawan = [
            [
                'id' => 1, 
                'nama' => 'Ahmad Rizki', 
                'jabatan' => 'Staff IT',
                'department' => 'IT'
            ],
            [
                'id' => 2, 
                'nama' => 'Siti Nurhaliza', 
                'jabatan' => 'HR Manager',
                'department' => 'HRD'
            ],
            [
                'id' => 3, 
                'nama' => 'Budi Santoso', 
                'jabatan' => 'Finance Staff',
                'department' => 'Finance'
            ],
            [
                'id' => 4, 
                'nama' => 'Maya Sari', 
                'jabatan' => 'Marketing Executive',
                'department' => 'Marketing'
            ],
            [
                'id' => 5, 
                'nama' => 'Rizky Pratama', 
                'jabatan' => 'IT Support',
                'department' => 'IT'
            ],
            [
                'id' => 6, 
                'nama' => 'Dewi Anggraini', 
                'jabatan' => 'Accounting Staff',
                'department' => 'Finance'
            ]
        ];

        $data = [
            'title' => 'Absensi Harian - Sistem Absensi',
            'karyawan' => $karyawan,
            'total_karyawan' => count($karyawan),
            'tanggal_sekarang' => now()->format('d F Y'),
            'waktu_sekarang' => now()->format('H:i:s')
        ];

        return view('karyawan.absensi', $data);
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'selected' => 'nullable|array',
            'status' => 'required|array',
            'keterangan' => 'nullable|array',
            'waktu' => 'required|array'
        ]);

        // Simulasi penyimpanan data
        // Di sini biasanya Anda akan menyimpan ke database
        $selectedCount = count($request->selected ?? []);
        
        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.absensi')
            ->with('success', "Absensi berhasil disimpan untuk {$selectedCount} karyawan!");
    }

    public function laporan()
    {
        $data = [
            'title' => 'Laporan Absensi - Sistem Absensi',
            'periode' => now()->format('F Y'),
            'statistik' => [
                'total_hadir' => 22,
                'total_izin' => 2,
                'total_sakit' => 1,
                'total_alpha' => 0,
                'persentase_kehadiran' => 88
            ]
        ];

        return view('karyawan.absensi', $data);
    }

    public function checkIn(Request $request)
    {
        // Logic untuk check-in
        return response()->json([
            'success' => true,
            'message' => 'Check-in berhasil dicatat',
            'waktu' => now()->format('H:i:s')
        ]);
    }

    public function checkOut(Request $request)
    {
        // Logic untuk check-out
        return response()->json([
            'success' => true,
            'message' => 'Check-out berhasil dicatat',
            'waktu' => now()->format('H:i:s')
        ]);
    }
}