@extends('layouts.app')

@section('title', 'Cek Status Booking - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">Cek Status Booking</h1>
    
    <!-- Search Form -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <form method="POST" action="/booking/status" class="space-y-4">
            @csrf
            <div>
                <label for="kode_booking" class="block text-gray-700 font-bold mb-2">Masukkan Kode Booking</label>
                <div class="flex gap-2">
                    <input type="text" id="kode_booking" name="kode_booking" placeholder="Contoh: JTA-20240523-XXXX"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                        value="{{ old('kode_booking', $booking->kode_booking ?? '') }}" required>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                        <i class="fas fa-search mr-2"></i>Cek
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Booking Details -->
    @if(isset($booking))
        <div class="bg-white p-8 rounded-lg shadow-md">
            <!-- Booking Header -->
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Kode Booking</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $booking->kode_booking }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="text-2xl font-bold">
                            <span class="px-4 py-2 rounded-full text-white
                                @if($booking->status === 'Menunggu') bg-yellow-500
                                @elseif($booking->status === 'Diproses') bg-blue-500
                                @elseif($booking->status === 'Dijadwalkan') bg-purple-500
                                @elseif($booking->status === 'Selesai') bg-green-500
                                @elseif($booking->status === 'Dibatalkan') bg-red-500
                                @endif">
                                {{ $booking->status }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Booking Info -->
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Booking</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Booking</p>
                            <p class="font-semibold">{{ Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Pengiriman</p>
                            <p class="font-semibold">{{ Carbon\Carbon::parse($booking->tanggal_pengiriman)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Layanan</p>
                            <p class="font-semibold">{{ $booking->layanan->nama_layanan }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Rute Pengiriman</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Asal</p>
                            <p class="font-semibold">{{ $booking->asal }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tujuan</p>
                            <p class="font-semibold">{{ $booking->tujuan }}</p>
                        </div>
                        @if($booking->berat_barang)
                            <div>
                                <p class="text-sm text-gray-500">Berat Barang</p>
                                <p class="font-semibold">{{ number_format($booking->berat_barang, 2) }} kg</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($booking->detail_barang)
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Detail Barang</h3>
                    <p class="text-gray-700">{{ $booking->detail_barang }}</p>
                </div>
            @endif
            
            <!-- Status History -->
            <div>
                <h3 class="text-lg font-bold text-gray-800 mb-6">Riwayat Status</h3>
                <div class="space-y-4">
                    @forelse($booking->statusHistories->reverse() as $history)
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-4 h-4 bg-blue-600 rounded-full"></div>
                                @if(!$loop->last)
                                    <div class="w-1 h-12 bg-gray-200"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-bold text-gray-800">{{ $history->status }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ Carbon\Carbon::parse($history->created_at)->translatedFormat('d F Y H:i') }}
                                </p>
                                @if($history->keterangan)
                                    <p class="text-gray-700 mt-2">{{ $history->keterangan }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-2">
                                    Diupdate oleh: {{ $history->updatedBy->nama }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada riwayat status.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            @auth
                <a href="/booking/riwayat" class="inline-block px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-bold">
                    <i class="fas fa-list mr-2"></i>Lihat Semua Booking Saya
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
