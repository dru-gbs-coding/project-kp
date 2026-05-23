<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display the booking creation form.
     */
    public function create()
    {
        $layanan = Layanan::all();

        return view('booking.create', compact('layanan'));
    }

    /**
     * Store a new booking.
     */
    public function store(BookingRequest $request)
    {
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'layanan_id' => $request->layanan_id,
            'tanggal_booking' => now()->toDateString(),
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'detail_barang' => $request->detail_barang,
            'berat_barang' => $request->berat_barang,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('booking.status')
            ->with('success', "Booking berhasil dibuat! Kode booking Anda: {$booking->kode_booking}");
    }

    /**
     * Check booking status by code (public, without login).
     */
    public function cekStatus(Request $request)
    {
        if ($request->method() === 'POST') {
            $request->validate([
                'kode_booking' => 'required|string',
            ]);

            $booking = Booking::with(['layanan', 'user', 'statusHistories.updatedBy'])
                ->where('kode_booking', $request->kode_booking)
                ->firstOrFail();

            return view('booking.status', compact('booking'));
        }

        return view('booking.status');
    }

    /**
     * Display booking history for logged-in customer.
     */
    public function riwayat()
    {
        $bookings = Booking::with(['layanan', 'statusHistories'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('booking.riwayat', compact('bookings'));
    }
}
