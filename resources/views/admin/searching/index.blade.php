@extends('layouts.admin')

@section('page-title', 'Pencarian Global')

@section('content')
<!-- Search Form -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <form method="GET" action="/admin/searching" class="space-y-4">
        <div class="flex gap-2">
            <input type="text" name="q" placeholder="Cari booking, layanan, atau pelanggan..." 
                value="{{ request('q') }}"
                class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" required>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
        </div>
    </form>
</div>

<!-- Results -->
@if(request('q'))
    <!-- Bookings Results -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-boxes text-blue-600 mr-2"></i>Booking ({{ count($results['bookings']) }})
        </h3>
        
        @if(count($results['bookings']) > 0)
            <div class="space-y-3">
                @foreach($results['bookings'] as $booking)
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-blue-600">{{ $booking->kode_booking }}</p>
                                <p class="text-sm text-gray-600">
                                    {{ $booking->user->nama }} - {{ $booking->layanan->nama_layanan }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $booking->asal }} → {{ $booking->tujuan }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full text-white text-xs font-semibold
                                    @if($booking->status === 'Menunggu') bg-yellow-500
                                    @elseif($booking->status === 'Diproses') bg-blue-500
                                    @elseif($booking->status === 'Dijadwalkan') bg-purple-500
                                    @elseif($booking->status === 'Selesai') bg-green-500
                                    @elseif($booking->status === 'Dibatalkan') bg-red-500
                                    @endif">
                                    {{ $booking->status }}
                                </span>
                                <a href="/admin/bookings/{{ $booking->booking_id }}" class="block text-blue-600 text-sm hover:text-blue-700 font-bold mt-2">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada booking yang ditemukan.</p>
        @endif
    </div>
    
    <!-- Services Results -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-cube text-green-600 mr-2"></i>Layanan ({{ count($results['layanan']) }})
        </h3>
        
        @if(count($results['layanan']) > 0)
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($results['layanan'] as $item)
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <p class="font-bold text-gray-800">{{ $item->nama_layanan }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->deskripsi, 60) }}</p>
                        @if($item->harga)
                            <p class="text-green-600 font-semibold text-sm mt-2">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>
                        @endif
                        <a href="/admin/layanan" class="text-blue-600 text-sm hover:text-blue-700 font-bold mt-2 inline-block">
                            Kelola →
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada layanan yang ditemukan.</p>
        @endif
    </div>
    
    <!-- Users/Customers Results -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">
            <i class="fas fa-users text-orange-600 mr-2"></i>Pelanggan ({{ count($results['users']) }})
        </h3>
        
        @if(count($results['users']) > 0)
            <div class="space-y-3">
                @foreach($results['users'] as $user)
                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-gray-800">{{ $user->nama }}</p>
                                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $user->no_hp ?? 'Tidak ada telepon' }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Member sejak</p>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">Tidak ada pelanggan yang ditemukan.</p>
        @endif
    </div>
@else
    <div class="bg-white p-12 rounded-lg shadow-md text-center">
        <div class="text-6xl text-gray-400 mb-4">
            <i class="fas fa-search"></i>
        </div>
        <p class="text-gray-500 text-lg">Masukkan kata kunci untuk memulai pencarian</p>
    </div>
@endif
@endsection
