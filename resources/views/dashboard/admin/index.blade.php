@extends('partials.app')

@section('title', 'Dashboard - Admin')

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
                            <th>Nama Karyawan</th>
                            <th>Jenis Alat Berat</th>
                            <th>Jumlah</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->jenis_alat_berat }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->alasan }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        @if ($data->status == 'tunggu')
                                            <a class="btn btn-danger" data-toggle="modal"
                                                data-target="#TolakModal{{ $data->id }}"></i>
                                                Tolak
                                            </a>
                                            <div style="width: 20px;"></div>
                                            <a class="btn btn-success" data-toggle="modal"
                                                data-target="#SetujuModal{{ $data->id }}"></i>
                                                Setuju
                                            </a>
                                        @else
                                            @if ($data->status == 'disetujui_admin' || $data->status == 'ditolak_direktur' || $data->status == 'disetujui_direktur')
                                                <div class="text-center">
                                                    <button class="btn btn-success mb-3" disabled>Sudah Disetujui</button>
                                                    <br>
                                                    @if ($data->status == 'disetujui_admin')
                                                        <button class="btn btn-warning" disabled>Menunggu Persetujuan
                                                            Direktur</button>
                                                    @else
                                                        @if ($data->status == 'ditolak_direktur')
                                                            <button class="btn btn-danger" disabled>Ditolak
                                                                Direktur</button>
                                                        @elseif ($data->status == 'disetujui_direktur')
                                                            <button class="btn btn-success" disabled>Sudah Disetujui
                                                                Direktur</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            @elseif ($data->status == 'ditolak_admin')
                                                <button class="btn btn-danger" disabled>Sudah Ditolak</button>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="modal fade" id="TolakModal{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tolak Pengajuan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">Apakah anda yakin menolak pengajuan tersebut?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href="{{ route('admin.tolak', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-danger">Iya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="SetujuModal{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Setuju Pengajuan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">Apakah anda yakin menyetujui pengajuan tersebut?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href="{{ route('admin.setuju', Crypt::encrypt($data->id)) }}"
                                                        class="btn btn-success">Iya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
