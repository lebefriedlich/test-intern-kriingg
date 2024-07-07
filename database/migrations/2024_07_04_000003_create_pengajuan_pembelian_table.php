<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPembelianTable extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->string('jenis_alat_berat', 100);
            $table->integer('jumlah');
            $table->text('alasan');
            $table->enum('status', ['tunggu', 'disetujui_admin', 'disetujui_direktur', 'ditolak_admin', 'ditolak_direktur'])->default('tunggu');
            $table->foreignId('id_admin')->nullable()->constrained('users');
            $table->foreignId('id_direktur')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_pembelian');
    }
}
