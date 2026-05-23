<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminSearchController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;

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

// ========== PUBLIC ROUTES ==========
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// ========== AUTH ROUTES ==========
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ========== AUTHENTICATED ROUTES ==========
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ========== CUSTOMER ROUTES ==========
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/booking/riwayat', [BookingController::class, 'riwayat'])->name('booking.riwayat');
    });

    // ========== ADMIN ROUTES ==========
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Bookings Management
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');
        Route::patch('/bookings/{id}', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');

        // Services Management
        Route::get('/layanan', [AdminLayananController::class, 'index'])->name('admin.layanan.index');
        Route::post('/layanan', [AdminLayananController::class, 'store'])->name('admin.layanan.store');
        Route::put('/layanan/{id}', [AdminLayananController::class, 'update'])->name('admin.layanan.update');
        Route::delete('/layanan/{id}', [AdminLayananController::class, 'destroy'])->name('admin.layanan.destroy');

        // Reports
        Route::get('/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');

        // Company Profile
        Route::get('/company', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
        Route::put('/company', [AdminCompanyController::class, 'update'])->name('admin.company.update');

        // Global Search
        Route::get('/searching', [AdminSearchController::class, 'index'])->name('admin.searching.index');
    });
});

// ========== PUBLIC BOOKING STATUS CHECK (NO LOGIN) ==========
Route::post('/booking/status', [BookingController::class, 'cekStatus'])->name('booking.cekStatus');
Route::get('/booking/status', [BookingController::class, 'cekStatus'])->name('booking.status');
