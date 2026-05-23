<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Layanan;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $layanan = Layanan::limit(3)->get();
        $company = CompanyProfile::first();

        return view('home.index', compact('layanan', 'company'));
    }
}
