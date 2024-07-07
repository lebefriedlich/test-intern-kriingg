@extends('partials.app')

@section('title', 'Dashboard - Karyawan')

@section('content')
    @if (session('success'))
        <div class="position-fixed" style="top: 100px; right: 20px; z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Surat Pembelian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari, Tanggal Pengajuan</th>
                            <th>Jenis Alat Berat</th>
                            <th>Jumlah</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="text-dark">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->translatedFormat('l, d F Y') }}</td>
                                <td class="text-dark">{{ $data->jenis_alat_berat }}</td>
                                <td class="text-dark">{{ $data->jumlah }}</td>
                                <td class="text-dark">{{ $data->alasan }}</td>
                                <td>
                                    @if ($data->status == 'tunggu')
                                        <p class="text-dark"><span class="badge badge-warning">Belum Disetujui</span> oleh
                                            Admin</p>
                                        <p class="text-dark"><span class="badge badge-warning">Belum Disetujui</span> oleh
                                            Direktur</p>
                                    @elseif ($data->status == 'disetujui_admin')
                                        <p class="text-dark"><span class="badge badge-success">Disetujui</span> oleh Admin
                                        </p>
                                        <p class="text-dark"><span class="badge badge-warning">Belum Disetujui</span> oleh
                                            Direktur</p>
                                    @elseif ($data->status == 'disetujui_direktur')
                                        <p class="text-dark"><span class="badge badge-success">Disetujui</span> oleh Admin
                                        </p>
                                        <p class="text-dark"><span class="badge badge-success">Disetujui</span> oleh
                                            Direktur</p>
                                    @elseif ($data->status == 'ditolak_admin')
                                        <p class="text-dark"><span class="badge badge-danger">Ditolak</span> oleh Admin</p>
                                        <p class="text-dark"><span class="badge badge-warning">Belum Diterima</span> oleh
                                            Direktur</p>
                                    @elseif ($data->status == 'ditolak_direktur')
                                        <p class="text-dark"><span class="badge badge-success">Disetujui</span> oleh Admin
                                        </p>
                                        <p class="text-dark"><span class="badge badge-danger">Ditolak</span> oleh Direktur
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->status == 'disetujui_direktur')
                                        <a href="{{ route('karyawan.cetakRequest', Crypt::encrypt($data->id)) }}"
                                            class="btn btn-primary fw-bolder py-1"><i class="bi bi-printer-fill"></i>
                                            Cetak</a>
                                    @elseif ($data->status == 'ditolak_admin' || $data->status == 'ditolak_direktur')
                                        <button class="btn btn-danger fw-bolder py-1" disabled><i class="bi bi-printer-fill"></i>
                                            Ditolak</button>
                                    @else
                                        <button class="btn btn-warning fw-bolder py-1" disabled><i class="bi bi-printer-fill"></i>
                                            Tunggu</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
