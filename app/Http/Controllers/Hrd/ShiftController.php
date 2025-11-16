<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     * Method ini yang akan dipanggil oleh route
     */
    public function shift()
    {
        // Data sample untuk sementara
        $shifts = [
            (object)[
                'id' => 1,
                'name' => 'Shift Pagi',
                'start_time' => '08:00',
                'end_time' => '16:00',
                'is_active' => true,
                'created_at' => now()
            ],
            (object)[
                'id' => 2,
                'name' => 'Shift Sore',
                'start_time' => '16:00',
                'end_time' => '24:00',
                'is_active' => true,
                'created_at' => now()->subDays(1)
            ],
            (object)[
                'id' => 3,
                'name' => 'Shift Malam',
                'start_time' => '00:00',
                'end_time' => '08:00',
                'is_active' => false,
                'created_at' => now()->subDays(2)
            ]
        ];

        $shifts = collect($shifts);

        return view('hrd.shift', compact('shifts'));
    }

    /**
     * JIKA ANDA INGIN MEMBUAT METHOD shift() KHUSUS, TAMBAHKAN:
     */

     // Tambahkan method absen yang missing
    public function absen(Request $request)
    {
        // Logika absen di sini
        return view('hrd.absensi'); // atau logika lainnya
    }

    // Atau untuk REST API
    public function absenStore(Request $request)
    {
        // Logika menyimpan data absen
        return response()->json(['message' => 'Absen berhasil']);
    }
}