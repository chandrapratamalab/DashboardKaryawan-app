<?php

namespace App\Http\Controllers\Hrd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{
    
    public function dataKaryawan()
    {
        return view('hrd.employees', [
            'pageTitle' => 'Data Karyawan'
        ]);
    }

    public function dataUser()
    {
        return view('hrd.data_user', [  
            'pageTitle' => 'Data User'
        ]);
    }
    public function index()
{
    // PASTIKAN INI: User::paginate() bukan User::all()
    $users = User::orderBy('created_at', 'desc')->paginate(10);
    
    $totalUsers = User::count();
    $activeUsers = User::where('is_active', true)->count();
    $adminCount = User::where('role', 'admin')->count();
    $unverifiedCount = User::whereNull('email_verified_at')->count();
    $newThisMonth = User::whereMonth('created_at', now()->month)
                       ->whereYear('created_at', now()->year)
                       ->count();

    return view('hrd.data_user.index', compact(
        'users', // Ini akan jadi Pagination object
        'totalUsers', 
        'activeUsers',
        'adminCount',
        'unverifiedCount', 
        'newThisMonth'
    ));
}
}
