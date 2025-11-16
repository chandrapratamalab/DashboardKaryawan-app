<?php

namespace App\Http\Controllers\Hrd; // Namespace yang benar

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('hrd.dashboard', [
            'pageTitle' => 'Dashboard HRD'
        ]);
        
            // Mock data untuk development frontend
            $totalEmployees = 45;
            $activeEmployees = 42;
            $pendingLeaves = 8;
            $todayAttendance = 38;
            $activeShifts = 3;
            $morningShift = 15;
            $eveningShift = 12;
            $lateEmployees = 5;
    
            // Data untuk chart kehadiran
            $weeklyAttendance = [
                ['day' => 'Sen', 'present' => 38, 'percentage' => 85],
                ['day' => 'Sel', 'present' => 40, 'percentage' => 89],
                ['day' => 'Rab', 'present' => 35, 'percentage' => 78],
                ['day' => 'Kam', 'present' => 42, 'percentage' => 93],
                ['day' => 'Jum', 'present' => 37, 'percentage' => 82],
                ['day' => 'Sab', 'present' => 20, 'percentage' => 45],
                ['day' => 'Min', 'present' => 15, 'percentage' => 33],
            ];
    
            // Data aktivitas terbaru - LANGSUNG DI SINI
            $recentActivities = [
                [
                    'icon' => 'user-clock',
                    'message' => 'John Doe check-in terlambat 15 menit',
                    'time' => '08:15'
                ],
                [
                    'icon' => 'calendar-check',
                    'message' => 'Jane Smith mengajukan cuti',
                    'time' => '09:30'
                ],
                [
                    'icon' => 'exchange-alt',
                    'message' => 'Mike Johnson pindah shift pagi ke sore',
                    'time' => '10:45'
                ],
                [
                    'icon' => 'user-plus',
                    'message' => 'Sarah Wilson bergabung sebagai karyawan baru',
                    'time' => '13:20'
                ],
                [
                    'icon' => 'clipboard-list',
                    'message' => 'Laporan kehadiran bulanan telah di-generate',
                    'time' => '15:00'
                ],
            ];
    
            return view('hrd.dashboard', [
                'totalEmployees' => $totalEmployees,
                'activeEmployees' => $activeEmployees,
                'pendingLeaves' => $pendingLeaves,
                'todayAttendance' => $todayAttendance,
                'activeShifts' => $activeShifts,
                'morningShift' => $morningShift,
                'eveningShift' => $eveningShift,
                'lateEmployees' => $lateEmployees,
                'weeklyAttendance' => $weeklyAttendance,
                'recentActivities' => $recentActivities, // Langsung dari array
            ]);
        }

    public function login()
    {
        return view('hrd.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('hrd.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
}