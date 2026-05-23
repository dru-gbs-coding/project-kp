@extends('layouts.app')

@section('title', 'Layanan - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-4">Layanan Kami</h1>
    <p class="text-gray-600 text-lg mb-12">Kami menyediakan berbagai layanan forwarding untuk memenuhi kebutuhan logistik Anda.</p>
    
    <div class="grid md:grid-cols-2 gap-8">
        @forelse($layanan as $item)
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-2xl font-bold text-blue-600">{{ $item->nama_layanan }}</h3>
                    </div>
                    <div class="text-3xl text-blue-600">
                        <i class="fas fa-cube"></i>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6">{{ $item->deskripsi }}</p>
                
                <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                    @if($item->estimasi_waktu)
                        <p class="text-gray-600">
                            <i class="fas fa-clock text-blue-600 mr-3"></i>
                            <strong>Estimasi:</strong> {{ $item->estimasi_waktu }}
                        </p>
                    @endif
                    
                    @if($item->harga)
                        <p class="text-gray-600">
                            <i class="fas fa-tag text-blue-600 mr-3"></i>
                            <strong>Harga:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>
                    @endif
                </div>
                
                @auth
                    <a href="/booking" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        <i class="fas fa-arrow-right mr-2"></i>Pesan Sekarang
                    </a>
                @else
                    <a href="/register" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        <i class="fas fa-user-plus mr-2"></i>Daftar & Pesan
                    </a>
                @endauth
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-2 py-12">Belum ada layanan yang tersedia saat ini.</p>
        @endforelse
    </div>
    
    <!-- CTA Section -->
    <div class="bg-blue-50 p-8 rounded-lg mt-12 text-center">
        <h2 class="text-2xl font-bold mb-4">Butuh Layanan Khusus?</h2>
        <p class="text-gray-700 mb-6">Hubungi kami untuk mendapatkan penawaran khusus sesuai kebutuhan Anda.</p>
        <a href="/kontak" class="inline-block px-8 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            <i class="fas fa-envelope mr-2"></i>Hubungi Kami
        </a>
    </div>
</div>
@endsection
