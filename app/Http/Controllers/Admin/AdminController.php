<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'Menunggu')->count();
        $processingBookings = Booking::where('status', 'Diproses')->count();
        $completedBookings = Booking::where('status', 'Selesai')->count();

        // Get recent bookings
        $recentBookings = Booking::with(['user', 'layanan'])
            ->latest()
            ->limit(5)
            ->get();

        // Get booking trend (last 7 days)
        $bookingTrend = Booking::whereBetween('created_at', [
            Carbon::now()->subDays(7),
            Carbon::now(),
        ])->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'processingBookings',
            'completedBookings',
            'recentBookings',
            'bookingTrend'
        ));
    }
}
