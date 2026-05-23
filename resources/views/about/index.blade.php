@extends('layouts.app')

@section('title', 'Tentang Kami - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    @if($company)
        <h1 class="text-4xl font-bold mb-4">{{ $company->nama_perusahaan }}</h1>
        
        <div class="grid md:grid-cols-2 gap-12 mb-12">
            <div>
                <h2 class="text-2xl font-bold text-blue-600 mb-4">Sejarah Perusahaan</h2>
                <p class="text-gray-700 leading-relaxed mb-6">{{ $company->sejarah }}</p>
                
                <h2 class="text-2xl font-bold text-blue-600 mb-4 mt-8">Visi Kami</h2>
                <p class="text-gray-700 leading-relaxed mb-6">{{ $company->visi }}</p>
                
                <h2 class="text-2xl font-bold text-blue-600 mb-4 mt-8">Misi Kami</h2>
                <p class="text-gray-700 leading-relaxed">{{ $company->misi }}</p>
            </div>
            
            <div class="bg-blue-50 p-8 rounded-lg">
                <h2 class="text-2xl font-bold text-blue-600 mb-6">Informasi Kontak</h2>
                
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>Alamat
                        </h3>
                        <p class="text-gray-700">{{ $company->alamat }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <i class="fas fa-phone text-blue-600 mr-3"></i>Telepon
                        </h3>
                        <p class="text-gray-700">{{ $company->telepon }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <i class="fas fa-envelope text-blue-600 mr-3"></i>Email
                        </h3>
                        <p class="text-gray-700">{{ $company->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Why Choose Us -->
        <div class="bg-gray-50 p-8 rounded-lg">
            <h2 class="text-2xl font-bold text-blue-600 mb-8">Mengapa Memilih Kami?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Profesional</h3>
                    <p class="text-gray-700">Tim profesional dengan pengalaman bertahun-tahun di industri forwarding.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Cepat & Efisien</h3>
                    <p class="text-gray-700">Layanan pengiriman yang cepat dengan sistem tracking real-time.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-700">Asuransi lengkap dan keamanan barang terjamin.</p>
                </div>
            </div>
        </div>
    @else
        <p class="text-gray-500 text-center py-12">Informasi perusahaan tidak tersedia.</p>
    @endif
</div>
@endsection
