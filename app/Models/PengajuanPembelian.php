<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPembelian extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_pembelian';

    protected $fillable = [
        'id_user',
        'tanggal_pengajuan',
        'jenis_alat_berat',
        'jumlah',
        'alasan',
        'status',
        'id_admin',
        'id_direktur',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function direktur()
    {
        return $this->belongsTo(User::class, 'id_direktur');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
