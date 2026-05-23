@extends('layouts.app')

@section('title', 'Beranda - PT Janur Tangguh Abadi')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-5xl font-bold mb-6">Solusi Forwarding Terpercaya</h1>
        <p class="text-xl mb-8 text-blue-100">Kami menyediakan layanan pengiriman barang internasional dengan standar profesional tinggi.</p>
        @guest
            <a href="/register" class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition">
                <i class="fas fa-arrow-right mr-2"></i>Daftar Sekarang
            </a>
        @else
            <a href="/booking" class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition">
                <i class="fas fa-plus mr-2"></i>Buat Booking Baru
            </a>
        @endguest
    </div>
</div>

<!-- Highlight Services -->
<div class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold text-center mb-12">Layanan Unggulan Kami</h2>
    <div class="grid md:grid-cols-3 gap-8">
        @forelse($layanan as $item)
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition">
                <div class="text-4xl text-blue-600 mb-4">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $item->nama_layanan }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($item->deskripsi, 100) }}</p>
                @if($item->estimasi_waktu)
                    <p class="text-sm text-gray-500 mb-2">
                        <i class="fas fa-clock mr-2"></i>{{ $item->estimasi_waktu }}
                    </p>
                @endif
                @if($item->harga)
                    <p class="text-blue-600 font-bold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-3">Belum ada layanan yang tersedia.</p>
        @endforelse
    </div>
    <div class="text-center mt-8">
        <a href="/layanan" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Lihat Semua Layanan
        </a>
    </div>
</div>

<!-- About Section -->
@if($company)
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8">Tentang {{ $company->nama_perusahaan }}</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-bold text-blue-600 mb-4">Visi</h3>
                <p class="text-gray-700 mb-6">{{ $company->visi }}</p>
                <h3 class="text-xl font-bold text-blue-600 mb-4">Misi</h3>
                <p class="text-gray-700">{{ $company->misi }}</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-blue-600 mb-4">Informasi Kontak</h3>
                <p class="text-gray-700 mb-3">
                    <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>{{ $company->alamat }}
                </p>
                <p class="text-gray-700 mb-3">
                    <i class="fas fa-phone text-blue-600 mr-3"></i>{{ $company->telepon }}
                </p>
                <p class="text-gray-700 mb-3">
                    <i class="fas fa-envelope text-blue-600 mr-3"></i>{{ $company->email }}
                </p>
            </div>
        </div>
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="bg-blue-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Siap Memulai Pengiriman?</h2>
        <p class="text-xl mb-8 text-blue-100">Buat booking sekarang dan nikmati layanan pengiriman terbaik dari kami.</p>
        @auth
            <a href="/booking" class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition">
                Buat Booking
            </a>
        @else
            <a href="/register" class="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition">
                Daftar & Booking
            </a>
        @endauth
    </div>
</div>
@endsection
