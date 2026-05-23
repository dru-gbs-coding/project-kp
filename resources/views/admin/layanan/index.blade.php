@extends('layouts.admin')

@section('page-title', 'Kelola Layanan')

@section('content')
<!-- Add Service Button -->
<div class="mb-6">
    <button onclick="openModal('createModal')" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
        <i class="fas fa-plus mr-2"></i>Tambah Layanan Baru
    </button>
</div>

<!-- Services Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Nama Layanan</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Deskripsi</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Harga</th>
                    <th class="px-6 py-4 text-left font-bold text-gray-800">Estimasi</th>
                    <th class="px-6 py-4 text-center font-bold text-gray-800">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($layanan as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold">{{ $item->nama_layanan }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ Str::limit($item->deskripsi, 50) }}</td>
                        <td class="px-6 py-4">
                            @if($item->harga)
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $item->estimasi_waktu ?? '-' }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button onclick="editService('{{ $item->layanan_id }}', '{{ addslashes($item->nama_layanan) }}', '{{ addslashes($item->deskripsi) }}', '{{ $item->harga }}', '{{ $item->estimasi_waktu }}')" 
                                class="px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-sm font-semibold inline-block">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                            <form method="DELETE" action="/admin/layanan/{{ $item->layanan_id }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition text-sm font-semibold">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada layanan. <a href="#" onclick="openModal('createModal')" class="text-blue-600 hover:text-blue-700 font-bold">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $layanan->links() }}
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
        <h3 class="text-2xl font-bold text-gray-800 mb-6" id="modalTitle">Tambah Layanan Baru</h3>
        
        <form id="serviceForm" method="POST" action="/admin/layanan" class="space-y-4">
            @csrf
            <input type="hidden" id="methodField" value="POST">
            
            <div>
                <label for="nama_layanan" class="block text-gray-700 font-bold mb-2">Nama Layanan</label>
                <input type="text" id="nama_layanan" name="nama_layanan" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Contoh: Pengiriman Domestik" required>
            </div>
            
            <div>
                <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Jelaskan layanan ini..."></textarea>
            </div>
            
            <div>
                <label for="harga" class="block text-gray-700 font-bold mb-2">Harga (Opsional)</label>
                <input type="number" id="harga" name="harga" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="0" step="0.01" min="0">
            </div>
            
            <div>
                <label for="estimasi_waktu" class="block text-gray-700 font-bold mb-2">Estimasi Waktu</label>
                <input type="text" id="estimasi_waktu" name="estimasi_waktu" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-600"
                    placeholder="Contoh: 3-5 hari kerja">
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <button type="button" onclick="closeModal('createModal')" class="flex-1 px-4 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition font-bold">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Tambah Layanan Baru';
    document.getElementById('serviceForm').action = '/admin/layanan';
    document.getElementById('methodField').value = 'POST';
    document.getElementById('nama_layanan').value = '';
    document.getElementById('deskripsi').value = '';
    document.getElementById('harga').value = '';
    document.getElementById('estimasi_waktu').value = '';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function editService(id, nama, deskripsi, harga, estimasi) {
    openModal('createModal');
    document.getElementById('modalTitle').textContent = 'Edit Layanan';
    document.getElementById('serviceForm').action = `/admin/layanan/${id}`;
    document.getElementById('methodField').value = 'PUT';
    document.getElementById('nama_layanan').value = nama;
    document.getElementById('deskripsi').value = deskripsi;
    document.getElementById('harga').value = harga || '';
    document.getElementById('estimasi_waktu').value = estimasi || '';
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('createModal');
    if (event.target === modal) {
        closeModal('createModal');
    }
});
</script>
@endsection
