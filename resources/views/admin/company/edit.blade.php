@extends('layouts.admin')

@section('page-title', 'Profil Perusahaan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profil Perusahaan</h2>
        
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="PUT" action="/admin/company" class="space-y-6">
            @csrf
            
            <div>
                <label for="nama_perusahaan" class="block text-gray-700 font-bold mb-2">Nama Perusahaan</label>
                <input type="text" id="nama_perusahaan" name="nama_perusahaan" 
                    value="{{ $company->nama_perusahaan ?? '' }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="PT Janur Tangguh Abadi" required>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" 
                        value="{{ $company->email ?? '' }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                        placeholder="info@janur.com">
                </div>
                
                <div>
                    <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon</label>
                    <input type="tel" id="telepon" name="telepon" 
                        value="{{ $company->telepon ?? '' }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                        placeholder="031-XXXXXXX">
                </div>
            </div>
            
            <div>
                <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Jalan ..., Surabaya, Jawa Timur">{{ $company->alamat ?? '' }}</textarea>
            </div>
            
            <div>
                <label for="visi" class="block text-gray-700 font-bold mb-2">Visi Perusahaan</label>
                <textarea id="visi" name="visi" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Jelaskan visi perusahaan...">{{ $company->visi ?? '' }}</textarea>
            </div>
            
            <div>
                <label for="misi" class="block text-gray-700 font-bold mb-2">Misi Perusahaan</label>
                <textarea id="misi" name="misi" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Jelaskan misi perusahaan...">{{ $company->misi ?? '' }}</textarea>
            </div>
            
            <div>
                <label for="sejarah" class="block text-gray-700 font-bold mb-2">Sejarah Perusahaan</label>
                <textarea id="sejarah" name="sejarah" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Ceritakan sejarah perusahaan...">{{ $company->sejarah ?? '' }}</textarea>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
                <a href="/admin/dashboard" class="flex-1 px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition font-bold text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
