<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display the services page.
     */
    public function index()
    {
        $layanan = Layanan::all();

        return view('layanan.index', compact('layanan'));
    }
}
