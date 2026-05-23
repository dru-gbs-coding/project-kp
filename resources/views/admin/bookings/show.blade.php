@extends('layouts.admin')

@section('page-title', 'Detail Booking')

@section('content')
<div class="grid grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="col-span-2">
        <!-- Booking Info Card -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="border-b border-gray-200 pb-4 mb-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Kode Booking</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $booking->kode_booking }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-white font-semibold
                        @if($booking->status === 'Menunggu') bg-yellow-500
                        @elseif($booking->status === 'Diproses') bg-blue-500
                        @elseif($booking->status === 'Dijadwalkan') bg-purple-500
                        @elseif($booking->status === 'Selesai') bg-green-500
                        @elseif($booking->status === 'Dibatalkan') bg-red-500
                        @endif">
                        {{ $booking->status }}
                    </span>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="font-bold text-gray-800 mb-4">Informasi Pelanggan</h3>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-semibold mb-3">{{ $booking->user->nama }}</p>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-semibold mb-3">{{ $booking->user->email }}</p>
                    <p class="text-sm text-gray-500">No. Telepon</p>
                    <p class="font-semibold">{{ $booking->user->no_hp ?? 'Tidak tersedia' }}</p>
                </div>
                
                <div>
                    <h3 class="font-bold text-gray-800 mb-4">Informasi Pengiriman</h3>
                    <p class="text-sm text-gray-500">Layanan</p>
                    <p class="font-semibold mb-3">{{ $booking->layanan->nama_layanan }}</p>
                    <p class="text-sm text-gray-500">Tanggal Booking</p>
                    <p class="font-semibold mb-3">{{ $booking->tanggal_booking->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500">Tanggal Pengiriman</p>
                    <p class="font-semibold">{{ $booking->tanggal_pengiriman->format('d/m/Y') }}</p>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <h3 class="font-bold text-gray-800 mb-4">Rute Pengiriman</h3>
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Asal</p>
                        <p class="font-semibold">{{ $booking->asal }}</p>
                    </div>
                    <div class="flex items-center justify-center">
                        <i class="fas fa-arrow-right text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tujuan</p>
                        <p class="font-semibold">{{ $booking->tujuan }}</p>
                    </div>
                </div>
            </div>
            
            @if($booking->detail_barang || $booking->berat_barang)
                <div class="border-t border-gray-200 mt-6 pt-6">
                    <h3 class="font-bold text-gray-800 mb-4">Detail Barang</h3>
                    @if($booking->detail_barang)
                        <p class="text-gray-700 mb-3">{{ $booking->detail_barang }}</p>
                    @endif
                    @if($booking->berat_barang)
                        <p class="text-gray-700">
                            <strong>Berat:</strong> {{ number_format($booking->berat_barang, 2) }} kg
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        <!-- Status History -->
        <div class="bg-white p-6 rounded-lg shadow-md">
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
                        <div class="flex-1">
                            <p class="font-bold text-gray-800">{{ $history->status }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $history->created_at->format('d/m/Y H:i') }}
                            </p>
                            @if($history->keterangan)
                                <p class="text-gray-700 text-sm mt-2">{{ $history->keterangan }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-2">
                                Diupdate oleh: <strong>{{ $history->updatedBy->nama }}</strong>
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada riwayat status.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Update Status Sidebar -->
    <div class="col-span-1">
        <div class="bg-white p-6 rounded-lg shadow-md sticky top-6">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Perbarui Status</h3>
            
            <form method="PATCH" action="/admin/bookings/{{ $booking->booking_id }}" class="space-y-4">
                @csrf
                
                <div>
                    <label for="status" class="block text-gray-700 font-bold mb-2">Status Baru</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
                        <option value="">-- Pilih Status --</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="keterangan" class="block text-gray-700 font-bold mb-2">Keterangan (Opsional)</label>
                    <textarea id="keterangan" name="keterangan" rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                        placeholder="Catatan atau penjelasan tentang status ini..."></textarea>
                </div>
                
                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </form>
            
            <div class="mt-6 pt-6 border-t border-gray-200">
                <a href="/admin/bookings" class="block text-center px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition font-bold">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
