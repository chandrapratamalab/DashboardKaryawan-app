<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LaporanAbsensiController;
use App\Http\Controllers\Karyawan\AbsensiController;
use App\Http\Controllers\Karyawan\RiwayatController;
use App\Http\Controllers\Karyawan\PengajuanController;
use App\Http\Controllers\Karyawan\ProfilController;
use App\Http\Controllers\Karyawan\NotifikasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AbsenceReportController;
use App\Http\Controllers\LaporanShiftController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\Hrd\DashboardController as HrdDashboardController;
use App\Http\Controllers\Hrd\ShiftController as HrdShiftController;
use App\Http\Controllers\Hrd\DataController as HrdDataController;
use App\Http\Controllers\Hrd\LaporanController as HrdLaporanController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Jika user sudah login, arahkan langsung ke dashboard sesuai role
    if (Auth::check()) {
        $role = Auth::user()->role;
        return redirect("/{$role}/dashboard");
    }

    // Kalau belum login, arahkan ke halaman login.blade.php
    return redirect('/login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function() { return view('Admin.dashboard'); });
});

Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/hrd/dashboard', function() { return view('hrd.dashboard'); });
});

/// Route untuk karyawan
Route::middleware(['auth'])->group(function () {
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('karyawan.dashboard');
        })->name('dashboard');
    });
        
    // Absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
    Route::post('/absensi/checkin', [AbsensiController::class, 'checkin'])->name('absensi.checkin');
    Route::post('/absensi/checkout', [AbsensiController::class, 'checkout'])->name('absensi.checkout');
    

    Route::get('/karyawan/riwayat', [RiwayatController::class, 'index'])->name('riwayat_kehadiran');

    // Pengajuan Izin/Cuti
    Route::get('/karyawan/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::delete('/pengajuan/{id}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
    
    // Profil Karyawan
    Route::get('/karyawan/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/upload-foto', [ProfilController::class, 'uploadFoto'])->name('profil.upload-foto');
    Route::post('/profil/ganti-password', [ProfilController::class, 'gantiPassword'])->name('profil.ganti-password');
    
    // Notifikasi
    Route::get('/karyawan/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])->name('notifikasi.show');
    Route::post('/notifikasi/mark-all-read', [NotifikasiController::class, 'markAllRead'])->name('notifikasi.mark-all-read');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
});

// Route default - redirect ke dashboard karyawan
Route::get('/', function () {
    return redirect()->route('karyawan.dashboard');
});

 // Tambahkan route untuk bulk actions dan lainnya
 Route::post('/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Employee Management
Route::resource('employees', EmployeeController::class);

//Data User
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// User Management
Route::resource('users', UserController::class);

// DATA SHIFT - Master Data Management
Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');

Route::get('/reports/absence', [AbsenceReportController::class, 'index'])->name('reports.absence');


// MENU LAPORAN ABSEN - untuk melihat laporan
Route::get('/Admin/laporan_absensi', [LaporanAbsensiController::class, 'index'])->name('Admin.laporan_absensi');


Route::get('/Admin/laporan_ketidakhadiran', [AbsenceReportController::class, 'index'])->name('Admin.laporan_ketidakhadiran');

Route::get('/admin/laporan_shift', [LaporanShiftController::class, 'index'])->name('admin.laporan_shift');

Route::get('/hrd/dashboard', [App\Http\Controllers\Hrd\DashboardController::class, 'index'])->name('hrd.dashboard');

// Route untuk Absensi Karyawan
Route::prefix('karyawan')->name('karyawan.')->group(function () {
    // Halaman absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
    
    // Simpan absensi
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
    
    // Laporan absensi
    Route::get('/absensi/laporan', [AbsensiController::class, 'laporan'])->name('absensi.laporan');
});

// HRD Routes Group
Route::prefix('hrd')->name('hrd.')->middleware(['auth', 'role:hrd'])->group(function () {
    
    // Dashboard HRD
    Route::get('/dashboard', [HrdDashboardController::class, 'index'])->name('dashboard');
    
    // Manajemen Shift
    Route::prefix('manajemen-shift')->name('manajemen-shift.')->group(function () {
        // Route untuk halaman shift (index)
        Route::get('/shift', [HrdShiftController::class, 'shift'])->name('shift');
        
        // Route untuk create shift - TAMBAHKAN INI
        Route::get('/shift/create', [HrdShiftController::class, 'create'])->name('shift.create');
        Route::post('/shift', [HrdShiftController::class, 'store'])->name('shift.store');
        Route::get('/absen', [HrdShiftController::class, 'absen'])->name('absen');
    });
    
    // Manajemen Data
    Route::prefix('manajemen-data')->name('manajemen-data.')->group(function () {
        Route::get('/data-karyawan', [HrdDataController::class, 'dataKaryawan'])->name('data-karyawan');
        Route::get('/data-user', [HrdDataController::class, 'dataUser'])->name('data-user');
    });
    
    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/ketidakhadiran', [HrdLaporanController::class, 'ketidakhadiran'])->name('ketidakhadiran');
        Route::get('/shift', [HrdLaporanController::class, 'shift'])->name('shift');
        Route::get('/absensi', [HrdLaporanController::class, 'absensi'])->name('absensi');
    });
});

// Default route untuk HRD
Route::redirect('/hrd', '/hrd/dashboard');

// Default route
Route::redirect('/', '/hrd/dashboard');



// Logout Route
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
