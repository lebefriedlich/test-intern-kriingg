<?php

namespace Database\Seeders;

use App\Models\PengajuanPembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengajuanPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengajuanPembelian::create([
            'id_user' => 1,
            'tanggal_pengajuan' => '2024-07-04',
            'jenis_alat_berat' => 'Excavator',
            'jumlah' => 2,
            'alasan' => 'Mempercepat proses penggalian dan pemindahan material.',
            'status' => 'ditolak_direktur',
            'id_admin' => 3,
            'id_direktur' => 4,
        ]);

        PengajuanPembelian::create([
            'id_user' => 1,
            'tanggal_pengajuan' => '2024-07-05',
            'jenis_alat_berat' => 'Buldozer',
            'jumlah' => 2,
            'alasan' => 'Meratakan dan memadatkan tanah dengan efisien.',
            'status' => 'disetujui_direktur',
            'id_admin' => 3,
            'id_direktur' => 4,
        ]);

        PengajuanPembelian::create([
            'id_user' => 2,
            'tanggal_pengajuan' => '2024-07-06',
            'jenis_alat_berat' => 'Dump Truck',
            'jumlah' => 3,
            'alasan' => 'Untuk mengangkut material seperti tanah, batu, atau pasir.',
            'status' => 'ditolak_admin',
            'id_admin' => 3,
        ]);

        PengajuanPembelian::create([
            'id_user' => 2,
            'tanggal_pengajuan' => '2024-07-06',
            'jenis_alat_berat' => 'Forklift',
            'jumlah' => 1,
            'alasan' => 'Untuk mengangkat dan memindahkan material di area yang sempit.',
            'status' => 'tunggu',
        ]);
    }
}
