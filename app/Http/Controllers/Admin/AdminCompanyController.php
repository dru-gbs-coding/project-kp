<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class AdminCompanyController extends Controller
{
    /**
     * Show the company profile edit form.
     */
    public function edit()
    {
        $company = CompanyProfile::first();

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the company profile.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'sejarah' => 'nullable|string',
            'alamat' => 'nullable|string',
            'email' => 'nullable|email|max:100',
            'telepon' => 'nullable|string|max:20',
        ]);

        $company = CompanyProfile::first();

        if ($company) {
            $company->update($validated);
        } else {
            CompanyProfile::create($validated);
        }

        return redirect()->back()->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}
