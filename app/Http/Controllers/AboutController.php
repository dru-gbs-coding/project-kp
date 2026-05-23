<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        $company = CompanyProfile::first();

        return view('about.index', compact('company'));
    }
}
