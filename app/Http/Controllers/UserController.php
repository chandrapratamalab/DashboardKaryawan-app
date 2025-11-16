<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        
        // Cek struktur tabel users terlebih dahulu
        $columns = DB::getSchemaBuilder()->getColumnListing('users');
        
        // Hitung statistik berdasarkan kolom yang ada
        $totalUsers = User::count();
        
        // Cek kolom status yang tersedia
        if (in_array('is_active', $columns)) {
            $activeUsers = User::where('is_active', true)->count();
        } elseif (in_array('status', $columns)) {
            $activeUsers = User::where('status', 'active')->count();
        } else {
            // Default: anggap semua user aktif jika tidak ada kolom status
            $activeUsers = $totalUsers;
        }
        
        // Hitung admin
        if (in_array('role', $columns)) {
            $adminCount = User::where('role', 'admin')
                            ->orWhere('role', 'HRD')
                            ->orWhere('role', 'Karyawan')
                            ->count();
        } else {
            $adminCount = 0;
        }
        
        // Hitung email unverified
        if (in_array('email_verified_at', $columns)) {
            $unverifiedCount = User::whereNull('email_verified_at')->count();
        } else {
            $unverifiedCount = 0;
        }
        
        // Hitung user baru bulan ini
        if (in_array('created_at', $columns)) {
            $newThisMonth = User::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->count();
        } else {
            $newThisMonth = 0;
        }
        
        return view('Admin.data_user', compact(
            'users', 
            'totalUsers', 
            'activeUsers', 
            'adminCount', 
            'unverifiedCount', 
            'newThisMonth',
            'columns' // untuk debugging
        ));
    }
}