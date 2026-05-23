@extends('layouts.app')

@section('title', 'Riwayat Booking - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">Riwayat Booking Saya</h1>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($bookings->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold text-gray-800">Kode Booking</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-800">Layanan</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-800">Tanggal</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-800">Asal - Tujuan</th>
                            <th class="px-6 py-4 text-left font-bold text-gray-800">Status</th>
                            <th class="px-6 py-4 text-center font-bold text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-blue-600">{{ $booking->kode_booking }}</span>
                                </td>
                                <td class="px-6 py-4">{{ $booking->layanan->nama_layanan }}</td>
                                <td class="px-6 py-4">
                                    {{ Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span>{{ Str::limit($booking->asal, 15) }}</span>
                                        <i class="fas fa-arrow-right text-blue-600"></i>
                                        <span>{{ Str::limit($booking->tujuan, 15) }}</span>
                                    </div>
                                </td>
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
                                    <a href="/booking/status" onclick="document.getElementById('kode_booking').value = '{{ $booking->kode_booking }}'; document.querySelector('form').submit(); return false;"
                                        class="text-blue-600 hover:text-blue-700 font-semibold">
                                        <i class="fas fa-eye mr-1"></i>Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="p-8 text-center">
                <p class="text-gray-500 text-lg mb-4">
                    <i class="fas fa-inbox text-4xl mb-4 block text-gray-400"></i>
                    Anda belum memiliki booking apapun.
                </p>
                <a href="/booking" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-plus mr-2"></i>Buat Booking Pertama
                </a>
            </div>
        @endif
    </div>
    
    <!-- Form Helper (hidden) -->
    <form id="checkStatusForm" method="POST" action="/booking/status" style="display: none;">
        @csrf
        <input type="hidden" id="kode_booking" name="kode_booking">
    </form>
</div>
@endsection
