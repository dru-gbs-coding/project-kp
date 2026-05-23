@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Booking</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalBookings }}</p>
            </div>
            <div class="text-4xl text-blue-600">
                <i class="fas fa-boxes"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Menunggu Proses</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $pendingBookings }}</p>
            </div>
            <div class="text-4xl text-yellow-600">
                <i class="fas fa-hourglass-start"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Sedang Diproses</p>
                <p class="text-3xl font-bold text-blue-600">{{ $processingBookings }}</p>
            </div>
            <div class="text-4xl text-blue-600">
                <i class="fas fa-spinner"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Selesai</p>
                <p class="text-3xl font-bold text-green-600">{{ $completedBookings }}</p>
            </div>
            <div class="text-4xl text-green-600">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Booking Terbaru</h2>
        <a href="/admin/bookings" class="text-blue-600 hover:text-blue-700 font-semibold">
            Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-800">Kode Booking</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-800">Pelanggan</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-800">Layanan</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-800">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-800">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentBookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <span class="font-semibold text-blue-600">{{ $booking->kode_booking }}</span>
                        </td>
                        <td class="px-4 py-3">{{ $booking->user->nama }}</td>
                        <td class="px-4 py-3">{{ $booking->layanan->nama_layanan }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                @if($booking->status === 'Menunggu') bg-yellow-500
                                @elseif($booking->status === 'Diproses') bg-blue-500
                                @elseif($booking->status === 'Dijadwalkan') bg-purple-500
                                @elseif($booking->status === 'Selesai') bg-green-500
                                @elseif($booking->status === 'Dibatalkan') bg-red-500
                                @endif">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $booking->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada booking.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid md:grid-cols-3 gap-6">
    <a href="/admin/bookings" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
        <div class="text-3xl text-blue-600 mb-3">
            <i class="fas fa-list"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Kelola Booking</h3>
        <p class="text-gray-500 text-sm">Lihat dan kelola semua booking pelanggan</p>
    </a>
    
    <a href="/admin/layanan" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
        <div class="text-3xl text-green-600 mb-3">
            <i class="fas fa-cube"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Kelola Layanan</h3>
        <p class="text-gray-500 text-sm">Tambah, edit, atau hapus layanan</p>
    </a>
    
    <a href="/admin/laporan" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
        <div class="text-3xl text-orange-600 mb-3">
            <i class="fas fa-file-pdf"></i>
        </div>
        <h3 class="font-bold text-gray-800 mb-2">Lihat Laporan</h3>
        <p class="text-gray-500 text-sm">Laporan booking dan statistik</p>
    </a>
</div>
@endsection
