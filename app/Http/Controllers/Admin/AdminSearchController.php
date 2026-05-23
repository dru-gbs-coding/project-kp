<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    /**
     * Display the global search page.
     */
    public function index(Request $request)
    {
        $results = [
            'bookings' => [],
            'layanan' => [],
            'users' => [],
        ];

        if ($request->filled('q')) {
            $search = $request->q;

            // Search bookings
            $results['bookings'] = Booking::where('kode_booking', 'like', "%{$search}%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->with(['user', 'layanan'])
                ->limit(10)
                ->get();

            // Search services
            $results['layanan'] = Layanan::where('nama_layanan', 'like', "%{$search}%")
                ->limit(10)
                ->get();

            // Search users (customers)
            $results['users'] = User::where('role', 'customer')
                ->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->limit(10)
                ->get();
        }

        return view('admin.searching.index', compact('results'));
    }
}
