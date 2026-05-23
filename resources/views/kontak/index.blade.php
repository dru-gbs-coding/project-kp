@extends('layouts.app')

@section('title', 'Kontak - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
    <p class="text-gray-600 text-lg mb-12">Kami siap membantu menjawab pertanyaan Anda tentang layanan kami.</p>
    
    <div class="grid md:grid-cols-2 gap-12">
        <!-- Contact Info -->
        <div>
            <h2 class="text-2xl font-bold mb-8">Informasi Kontak</h2>
            
            @if($company)
                <div class="space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-blue-600 mb-2">
                            <i class="fas fa-map-marker-alt mr-3"></i>Alamat
                        </h3>
                        <p class="text-gray-700">{{ $company->alamat }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-blue-600 mb-2">
                            <i class="fas fa-phone mr-3"></i>Telepon
                        </h3>
                        <a href="tel:{{ $company->telepon }}" class="text-gray-700 hover:text-blue-600">
                            {{ $company->telepon }}
                        </a>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-blue-600 mb-2">
                            <i class="fas fa-envelope mr-3"></i>Email
                        </h3>
                        <a href="mailto:{{ $company->email }}" class="text-gray-700 hover:text-blue-600">
                            {{ $company->email }}
                        </a>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-blue-600 mb-4">
                            <i class="fas fa-clock mr-3"></i>Jam Operasional
                        </h3>
                        <p class="text-gray-700">Senin - Jumat: 08:00 - 17:00 WIB</p>
                        <p class="text-gray-700">Sabtu: 08:00 - 13:00 WIB</p>
                        <p class="text-gray-700">Minggu: Tutup</p>
                    </div>
                </div>
            @else
                <p class="text-gray-500">Informasi kontak tidak tersedia.</p>
            @endif
        </div>
        
        <!-- Google Maps Embed -->
        <div>
            <h2 class="text-2xl font-bold mb-8">Lokasi Kami</h2>
            <div class="bg-gray-200 rounded-lg overflow-hidden h-96">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.9156235456347!2d112.74913!3d-7.243597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e4b9d2b4b4b5%3A0x5c5c5c5c5c5c5c5c!2sSurabaya%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1234567890123" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    
    <!-- Quick Contact Form -->
    <div class="bg-blue-50 p-8 rounded-lg mt-12">
        <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>
        <form class="space-y-4" action="#" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Anda</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-600" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-600" required>
                </div>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Subjek</label>
                <input type="text" name="subjek" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-600" required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Pesan</label>
                <textarea name="pesan" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-600" required></textarea>
            </div>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-bold">
                <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
            </button>
        </form>
    </div>
</div>
@endsection
