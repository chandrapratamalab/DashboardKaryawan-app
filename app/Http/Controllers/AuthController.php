<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if ($user && $user->password === $request->password) {
            Auth::login($user); // langsung login tanpa Auth::attempt()
    
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'hrd') {
                return redirect('/hrd/dashboard');
            } else {
                return redirect('/karyawan/dashboard');
            }
        }
    
        return back()->with('error', 'Email atau password salah!');
    }
    

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}

