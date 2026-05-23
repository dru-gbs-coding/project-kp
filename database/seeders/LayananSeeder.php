<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanan = [
            [
                'nama_layanan' => 'Pengiriman Domestik',
                'deskripsi' => 'Layanan pengiriman ke seluruh Indonesia dengan jaminan barang sampai dengan aman.',
                'harga' => 50000,
                'estimasi_waktu' => '3-5 hari kerja',
            ],
            [
                'nama_layanan' => 'Pengiriman Internasional',
                'deskripsi' => 'Layanan pengiriman ke mancanegara dengan asuransi penuh dan tracking real-time.',
                'harga' => 500000,
                'estimasi_waktu' => '7-14 hari kerja',
            ],
            [
                'nama_layanan' => 'Customs Clearance',
                'deskripsi' => 'Layanan pengurusan bea cukai dan dokumentasi impor-ekspor profesional.',
                'harga' => 250000,
                'estimasi_waktu' => '2-5 hari kerja',
            ],
            [
                'nama_layanan' => 'Door to Door Service',
                'deskripsi' => 'Layanan penjemputan dan pengiriman langsung ke pintu pelanggan.',
                'harga' => 150000,
                'estimasi_waktu' => '2-3 hari kerja',
            ],
            [
                'nama_layanan' => 'Freight Forwarding',
                'deskripsi' => 'Layanan logistik skala besar untuk pengiriman bulk cargo internasional.',
                'harga' => 1000000,
                'estimasi_waktu' => '10-21 hari kerja',
            ],
        ];

        foreach ($layanan as $item) {
            Layanan::create($item);
        }
    }
}
