<?php

namespace App\Http\Controllers;


use App\Models\PengajuanPembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KaryawanController extends Controller
{
    public function index()
    {
        $datas = PengajuanPembelian::where('id_user', auth()->user()->id)->get()->sortDesc();
        Carbon::setLocale('id');
        
        return view('dashboard.karyawan.index', compact('datas'));
    }

    public function request()
    {
        return view('dashboard.karyawan.request');
    }

    public function storeRequest(Request $request)
    {
        $messages = [
            'jenis_alat_berat.required' => 'Jenis alat berat wajib diisi.',
            'jumlah.required' => 'Jumlah alat berat wajib diisi.',
            'jumlah.numeric' => 'Jumlah alat berat harus berupa angka.',
            'alasan.required' => 'Alasan pembelian wajib diisi.',
        ];
    
        $request->validate([
            'jenis_alat_berat' => 'required',
            'jumlah' => 'required|numeric',
            'alasan' => 'required',
        ], $messages);

        PengajuanPembelian::create([
            'id_user' => auth()->user()->id,
            'tanggal_pengajuan' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
            'jenis_alat_berat' => $request->jenis_alat_berat,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
        ]);  

        return redirect()->route('karyawan.index')->with('success', 'Permintaan pembelian alat berat berhasil diajukan.')->withInput();
    }

    public function cetakRequest($id)
    {
        $id = Crypt::decrypt($id);

        $data = PengajuanPembelian::with('user')->find($id);
        Carbon::setLocale('id');

        return view('dashboard.karyawan.cetak', compact('data'));
    }
}
