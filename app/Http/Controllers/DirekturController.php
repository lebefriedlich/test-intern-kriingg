<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporan;
use App\Models\PengajuanPembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DirekturController extends Controller
{
    public function index()
    {
        $datas = PengajuanPembelian::with('user')->get()->sortDesc();
        Carbon::setLocale('id');
        $max_date = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        return view('dashboard.direktur.index', compact('datas', 'max_date'));
    }

    public function tolak($id)
    {
        $id = Crypt::decrypt($id);

        $data = PengajuanPembelian::find($id);
        $data->status = "ditolak_direktur";
        $data->id_direktur = auth()->user()->id;
        $data->save();

        return redirect()->route('direktur.index')->with('success', 'Permintaan pembelian alat berat berhasil ditolak.');
    }

    public function setuju($id)
    {
        $id = Crypt::decrypt($id);

        $data = PengajuanPembelian::find($id);
        $data->status = "disetujui_direktur";
        $data->id_direktur = auth()->user()->id;
        $data->save();

        return redirect()->route('direktur.index')->with('success', 'Permintaan pembelian alat berat berhasil disetujui.');
    }

    public function export(Request $request)
    {
        $messages = [
            'mulai_tanggal.required' => 'Mulai tanggal wajib diisi.',
            'mulai_tanggal.date' => 'Mulai tanggal harus berupa tanggal yang valid.',
            'sampai_tanggal.required' => 'Sampai tanggal wajib diisi.',
            'sampai_tanggal.date' => 'Sampai tanggal harus berupa tanggal yang valid.',
            'sampai_tanggal.after_or_equal' => 'Sampai tanggal harus sama dengan atau setelah mulai tanggal.',
        ];

        $validator = Validator::make($request->all(), [
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:mulai_tanggal',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_open', true);
        }

        $mulai_tanggal = $request->input('mulai_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');

        $mulai_tanggal_format = Carbon::createFromFormat('Y-m-d', $mulai_tanggal)->format('d-m-Y');
        $sampai_tanggal_format = Carbon::createFromFormat('Y-m-d', $sampai_tanggal)->format('d-m-Y');

        return Excel::download(new ExportLaporan($mulai_tanggal, $sampai_tanggal), 'data_permintaan (' . $mulai_tanggal_format . ' - ' . $sampai_tanggal_format . ').xlsx');
    }
}
