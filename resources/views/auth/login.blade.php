@extends('layouts.app')

@section('title', 'Login - PT Janur Tangguh Abadi')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Masuk ke Akun</h2>
        
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="/login" class="space-y-6">
            @csrf
            
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
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600" 
                    placeholder="Masukkan password" required>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                <i class="fas fa-sign-in-alt mr-2"></i>Masuk
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Belum punya akun? 
                <a href="/register" class="text-blue-600 hover:text-blue-700 font-bold">Daftar di sini</a>
            </p>
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-200 text-center">
            <p class="text-gray-600 text-sm mb-4">Atau lanjutkan sebagai</p>
            <a href="/" class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
                <i class="fas fa-globe mr-2"></i>Kunjungi Website
            </a>
        </div>
    </div>
</div>
@endsection
