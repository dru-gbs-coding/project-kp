<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    /**
     * Display the booking report page.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'layanan']);

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15);

        // Summary statistics
        $totalBookings = $query->count();
        $totalRevenue = $query->sum('bookings.berat_barang'); // Or actual price field
        $completedBookings = $query->where('status', 'Selesai')->count();

        $statuses = ['Menunggu', 'Diproses', 'Dijadwalkan', 'Selesai', 'Dibatalkan'];

        return view('admin.laporan.index', compact(
            'bookings',
            'totalBookings',
            'totalRevenue',
            'completedBookings',
            'statuses'
        ));
    }
}
