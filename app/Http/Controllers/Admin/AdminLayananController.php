<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    /**
     * Display a list of all services.
     */
    public function index()
    {
        $layanan = Layanan::latest()->paginate(10);

        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Store a new service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric|min:0',
            'estimasi_waktu' => 'nullable|string|max:50',
        ]);

        Layanan::create($validated);

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Update a service.
     */
    public function update(Request $request, string $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric|min:0',
            'estimasi_waktu' => 'nullable|string|max:50',
        ]);

        $layanan->update($validated);

        return redirect()->back()->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Delete a service.
     */
    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}
