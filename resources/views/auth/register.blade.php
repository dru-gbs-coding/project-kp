@extends('layouts.app')

@section('title', 'Daftar - PT Janur Tangguh Abadi')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Buat Akun Baru</h2>
        
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="/register" class="space-y-4">
            @csrf
            
            <div>
                <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('nama') border-red-500 @enderror" 
                    placeholder="Nama anda" required>
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('email') border-red-500 @enderror" 
                    placeholder="contoh@email.com" required>
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="no_hp" class="block text-gray-700 font-bold mb-2">Nomor Telepon (Opsional)</label>
                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" 
                    placeholder="08xxxxxxxxxx">
                @error('no_hp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat (Opsional)</label>
                <textarea id="alamat" name="alamat" rows="2" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600 @error('password') border-red-500 @enderror" 
                    placeholder="Minimal 6 karakter" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" 
                    placeholder="Ulangi password" required>
            </div>
            
            <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                <i class="fas fa-user-plus mr-2"></i>Daftar
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Sudah punya akun? 
                <a href="/login" class="text-blue-600 hover:text-blue-700 font-bold">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
