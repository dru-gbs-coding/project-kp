@extends('layouts.admin')

@section('page-title', 'Daftar Booking')

@section('content')
<!-- Filters -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <form method="GET" action="/admin/bookings" class="space-y-4">
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" placeholder="Cari kode atau nama pelanggan..." 
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600">
            </div>
            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600">
                    <option value="">-- Semua Status --</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="/admin/bookings" class="flex-1 px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition font-bold text-center">
                    Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Bookings Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Kode Booking</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Pelanggan</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Layanan</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Tanggal</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Status</th>
                    <th class="px-6 py-4 text-center font-bold text-gray-800">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-semibold text-blue-600">{{ $booking->kode_booking }}</span>
                        </td>
                        <td class="px-6 py-4">{{ $booking->user->nama }}</td>
                        <td class="px-6 py-4">{{ $booking->layanan->nama_layanan }}</td>
                        <td class="px-6 py-4">{{ $booking->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-white text-sm font-semibold
                                @if($booking->status === 'Menunggu') bg-yellow-500
                                @elseif($booking->status === 'Diproses') bg-blue-500
                                @elseif($booking->status === 'Dijadwalkan') bg-purple-500
                                @elseif($booking->status === 'Selesai') bg-green-500
                                @elseif($booking->status === 'Dibatalkan') bg-red-500
                                @endif">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="/admin/bookings/{{ $booking->booking_id }}" 
                                class="text-blue-600 hover:text-blue-700 font-semibold">
                                <i class="fas fa-eye mr-1"></i>Lihat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Belum ada booking.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
