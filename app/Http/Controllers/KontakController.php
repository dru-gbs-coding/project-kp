<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;

class KontakController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        $company = CompanyProfile::first();

        return view('kontak.index', compact('company'));
    }
}
