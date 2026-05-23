@extends('layouts.app')

@section('title', 'Buat Booking - PT Janur Tangguh Abadi')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">Buat Booking Baru</h1>
    
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="bg-white p-8 rounded-lg shadow-md">
        <form method="POST" action="/booking" class="space-y-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="layanan_id" class="block text-gray-700 font-bold mb-2">Pilih Layanan <span class="text-red-600">*</span></label>
                    <select id="layanan_id" name="layanan_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('layanan_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Layanan --</option>
                        @foreach($layanan as $item)
                            <option value="{{ $item->layanan_id }}" {{ old('layanan_id') == $item->layanan_id ? 'selected' : '' }}>
                                {{ $item->nama_layanan }}
                                @if($item->harga)
                                    (Rp {{ number_format($item->harga, 0, ',', '.') }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('layanan_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="tanggal_pengiriman" class="block text-gray-700 font-bold mb-2">Tanggal Pengiriman <span class="text-red-600">*</span></label>
                    <input type="date" id="tanggal_pengiriman" name="tanggal_pengiriman" value="{{ old('tanggal_pengiriman') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('tanggal_pengiriman') border-red-500 @enderror"
                        min="{{ now()->addDay()->toDateString() }}" required>
                    @error('tanggal_pengiriman')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="asal" class="block text-gray-700 font-bold mb-2">Asal Pengiriman <span class="text-red-600">*</span></label>
                    <input type="text" id="asal" name="asal" value="{{ old('asal') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('asal') border-red-500 @enderror"
                        placeholder="Nama kota/alamat pengiriman" required>
                    @error('asal')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="tujuan" class="block text-gray-700 font-bold mb-2">Tujuan Pengiriman <span class="text-red-600">*</span></label>
                    <input type="text" id="tujuan" name="tujuan" value="{{ old('tujuan') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('tujuan') border-red-500 @enderror"
                        placeholder="Nama kota/alamat tujuan" required>
                    @error('tujuan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div>
                <label for="detail_barang" class="block text-gray-700 font-bold mb-2">Detail Barang (Opsional)</label>
                <textarea id="detail_barang" name="detail_barang" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Jelaskan jenis barang, kondisi, dan detail lainnya...">{{ old('detail_barang') }}</textarea>
                @error('detail_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="berat_barang" class="block text-gray-700 font-bold mb-2">Berat Barang (kg) (Opsional)</label>
                <input type="number" id="berat_barang" name="berat_barang" value="{{ old('berat_barang') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="0.00" step="0.1" min="0.1">
                @error('berat_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="bg-blue-50 p-4 rounded-lg">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Setelah booking berhasil, Anda akan menerima kode booking yang dapat digunakan untuk melacak status pengiriman.
                </p>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-check mr-2"></i>Buat Booking
                </button>
                <a href="/" class="flex-1 px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-bold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
