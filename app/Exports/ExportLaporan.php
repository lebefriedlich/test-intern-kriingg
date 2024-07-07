<?php

namespace App\Exports;

use App\Models\PengajuanPembelian;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportLaporan implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $mulai_tanggal;
    protected $sampai_tanggal;

    public function __construct($mulai_tanggal, $sampai_tanggal)
    {
        $this->mulai_tanggal = $mulai_tanggal;
        $this->sampai_tanggal = $sampai_tanggal;
    }

    public function view(): View
    {
        $datas = PengajuanPembelian::with('user')->whereBetween('tanggal_pengajuan', [$this->mulai_tanggal, $this->sampai_tanggal])->get();
        Carbon::setLocale('id');

        return view('dashboard.direktur.export', compact('datas'));
    }
}
