<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT Janur Tangguh Abadi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('css')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="text-2xl font-bold text-blue-600">
                    <i class="fas fa-box-open mr-2"></i>JTA
                </a>

                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-blue-600 transition">Beranda</a>
                    <a href="/tentang" class="text-gray-700 hover:text-blue-600 transition">Tentang</a>
                    <a href="/layanan" class="text-gray-700 hover:text-blue-600 transition">Layanan</a>
                    <a href="/kontak" class="text-gray-700 hover:text-blue-600 transition">Kontak</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="/admin/dashboard" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fas fa-cog mr-2"></i>Admin
                            </a>
                        @else
                            <a href="/booking/riwayat" class="px-4 py-2 text-blue-600 hover:text-blue-700">
                                <i class="fas fa-history mr-2"></i>Riwayat
                            </a>
                        @endif
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="px-4 py-2 text-blue-600 hover:text-blue-700 border border-blue-600 rounded">
                            Login
                        </a>
                        <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if($message = session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative max-w-7xl mx-auto mt-4" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ $message }}
        </div>
    @endif

    @if($message = session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto mt-4" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
        </div>
    @endif

    <!-- Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">PT Janur Tangguh Abadi</h3>
                    <p class="text-gray-400">Layanan forwarding terpercaya untuk kebutuhan logistik Anda.</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Menu</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white">Beranda</a></li>
                        <li><a href="/tentang" class="hover:text-white">Tentang</a></li>
                        <li><a href="/layanan" class="hover:text-white">Layanan</a></li>
                        <li><a href="/kontak" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <p class="text-gray-400 mb-2"><i class="fas fa-phone mr-2"></i>{{ config('app.phone', '031-XXXXXXX') }}</p>
                    <p class="text-gray-400"><i class="fas fa-envelope mr-2"></i>{{ config('app.email', 'info@janur.com') }}</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2026 PT Janur Tangguh Abadi. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('js')
</body>
</html>
