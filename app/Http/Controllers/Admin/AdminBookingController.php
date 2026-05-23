<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\StatusBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    /**
     * Display a list of all bookings.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'layanan']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        $bookings = $query->latest()->paginate(15);
        $statuses = ['Menunggu', 'Diproses', 'Dijadwalkan', 'Selesai', 'Dibatalkan'];

        return view('admin.bookings.index', compact('bookings', 'statuses'));
    }

    /**
     * Display booking detail.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'layanan', 'statusHistories.updatedBy'])->findOrFail($id);
        $statuses = ['Menunggu', 'Diproses', 'Dijadwalkan', 'Selesai', 'Dibatalkan'];

        return view('admin.bookings.show', compact('booking', 'statuses'));
    }

    /**
     * Update booking status.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Dijadwalkan,Selesai,Dibatalkan',
            'keterangan' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($id);

        DB::transaction(function () use ($request, $booking) {
            $booking->update(['status' => $request->status]);

            StatusBooking::create([
                'booking_id' => $booking->booking_id,
                'updated_by' => Auth::id(),
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);
        });

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }
}
