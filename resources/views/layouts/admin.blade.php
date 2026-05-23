<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - PT Janur Tangguh Abadi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <h2 class="text-2xl font-bold">
                    <i class="fas fa-box-open mr-2"></i>JTA Admin
                </h2>
            </div>

            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                <a href="/admin/dashboard" class="block px-4 py-3 rounded {{ request()->is('admin/dashboard') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-chart-line mr-2"></i>Dashboard
                </a>
                <a href="/admin/bookings" class="block px-4 py-3 rounded {{ request()->is('admin/bookings*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-boxes mr-2"></i>Bookings
                </a>
                <a href="/admin/layanan" class="block px-4 py-3 rounded {{ request()->is('admin/layanan*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-cube mr-2"></i>Layanan
                </a>
                <a href="/admin/laporan" class="block px-4 py-3 rounded {{ request()->is('admin/laporan*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-file-pdf mr-2"></i>Laporan
                </a>
                <a href="/admin/company" class="block px-4 py-3 rounded {{ request()->is('admin/company*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-building mr-2"></i>Profil Perusahaan
                </a>
                <a href="/admin/searching" class="block px-4 py-3 rounded {{ request()->is('admin/searching*') ? 'bg-blue-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-search mr-2"></i>Pencarian
                </a>
            </nav>

            <div class="border-t border-gray-800 p-4">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold">{{ Auth::user()->nama }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-800 rounded text-sm">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <div class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-globe mr-2"></i>Kunjungi Website
                    </a>
                </div>
            </div>

            <!-- Alert Messages -->
            @if($message = session('success'))
                <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>{{ $message }}
                </div>
            @endif

            @if($message = session('error'))
                <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded" role="alert">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                </div>
            @endif

            <!-- Content Area -->
            <main class="flex-1 overflow-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('js')
</body>
</html>
