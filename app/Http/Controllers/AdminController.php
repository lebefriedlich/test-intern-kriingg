<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        $datas = PengajuanPembelian::with('user')->get()->sortDesc();
        Carbon::setLocale('id');

        return view('dashboard.admin.index', compact('datas'));
    }

    public function tolak($id)
    {
        $id = Crypt::decrypt($id);

        $data = PengajuanPembelian::find($id);
        $data->status = "ditolak_admin";
        $data->id_admin = auth()->user()->id;
        $data->save();

        return redirect()->route('admin.index')->with('success', 'Permintaan pembelian alat berat berhasil ditolak.');
    }

    public function setuju($id)
    {
        $id = Crypt::decrypt($id);

        $data = PengajuanPembelian::find($id);
        $data->status = "disetujui_admin";
        $data->id_admin = auth()->user()->id;
        $data->save();

        return redirect()->route('admin.index')->with('success', 'Permintaan pembelian alat berat berhasil disetujui.');
    }
}
