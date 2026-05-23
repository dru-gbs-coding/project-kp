<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::create([
            'nama_perusahaan' => 'PT Janur Tangguh Abadi',
            'visi' => 'Menjadi perusahaan forwarding terpercaya dan terdepan di Indonesia dengan standar layanan internasional.',
            'misi' => 'Memberikan layanan logistik yang cepat, aman, dan profesional untuk mendukung pertumbuhan bisnis pelanggan kami.',
            'sejarah' => 'PT Janur Tangguh Abadi didirikan pada tahun 2015 dengan komitmen untuk menyediakan solusi logistik terpadu. Sejak awal operasional, kami telah melayani ribuan pelanggan dengan dedikasi tinggi terhadap kepuasan dan keamanan barang. Pengalaman lebih dari 8 tahun dalam industri forwarding membuat kami memahami setiap kebutuhan spesifik pelanggan.',
            'alamat' => 'Jl. Tanjungsari No. 123, Surabaya 60188, Jawa Timur, Indonesia',
            'email' => 'info@janur.com',
            'telepon' => '031-7488-7488',
        ]);
    }
}
