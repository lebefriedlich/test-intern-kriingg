@extends('partials.app')

@section('title', 'Dashboard - Direktur')

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
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cetakModal">
                        <i class="bi bi-printer-fill"></i> Export Data Pengajuan
                    </button>
                </div>
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
                                            <div class="text-center">
                                                <button class="btn btn-warning mb-2" disabled>Belum Disetujui Admin</button>
                                                <br>
                                                <button class="btn btn-warning" disabled>Tunggu</button>
                                            </div>
                                        @elseif ($data->status == 'disetujui_admin')
                                            <div class="text-center">
                                                <button class="btn btn-success mb-2" disabled>Disetujui Admin</button>
                                                <br>
                                                <a class="btn btn-danger" data-toggle="modal"
                                                    data-target="#TolakModal{{ $data->id }}">
                                                    Tolak
                                                </a>
                                                <a class="btn btn-success my-2" data-toggle="modal"
                                                    data-target="#SetujuModal{{ $data->id }}">
                                                    Setuju
                                                </a>
                                            </div>
                                        @elseif ($data->status == 'ditolak_admin')
                                            <button class="btn btn-danger" disabled>Ditolak Admin</button>
                                        @else
                                            @if ($data->status == 'disetujui_direktur')
                                                <div class="text-center">
                                                    <button class="btn btn-success mb-2" disabled>Disetujui Admin</button>
                                                    <br>
                                                    <button class="btn btn-success" disabled>Sudah Disetujui</button>
                                                </div>
                                            @elseif ($data->status == 'ditolak_direktur')
                                                <div class="text-center">
                                                    <button class="btn btn-success mb-2" disabled>Disetujui Admin</button>
                                                    <br>
                                                    <button class="btn btn-danger" disabled>Sudah Ditolak</button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="modal fade" id="TolakModal{{ $data->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tolak Permintaan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">Apakah anda yakin menolak permintaan
                                                    tersebut?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href="{{ route('direktur.tolak', Crypt::encrypt($data->id)) }}"
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Setuju Permintaan</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">Apakah anda yakin Menyetujui permintaan
                                                    tersebut?
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Tidak</button>
                                                    <a href="{{ route('direktur.setuju', Crypt::encrypt($data->id)) }}"
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

    <div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cetakModalLabel">Cetak Data Pengajuan Pembelian Alat Berat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('direktur.export') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mulai_tanggal">Mulai Tanggal</label>
                            <input type="date" class="form-control @error('mulai_tanggal') is-invalid @enderror"
                                id="mulai_tanggal" name="mulai_tanggal" value="{{ old('mulai_tanggal') }}"
                                min="2024-07-04" max="{{ $max_date }}">
                            @if ($errors->has('mulai_tanggal'))
                                <span class="text-danger">{{ $errors->first('mulai_tanggal') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control @error('sampai_tanggal') is-invalid @enderror"
                                id="sampai_tanggal" name="sampai_tanggal" value="{{ old('sampai_tanggal') }}"
                                min="2024-07-04" max="{{ $max_date }}">
                            @if ($errors->has('sampai_tanggal'))
                                <span class="text-danger">{{ $errors->first('sampai_tanggal') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            @if (session('modal_open'))
                $('#cetakModal').modal('show');
            @endif
        });

        window.addEventListener('beforeunload', function(event) {
            $('#cetakModal').modal('hide');

            document.getElementById('mulai_tanggal').classList.remove('is-invalid');
            document.getElementById('sampai_tanggal').classList.remove('is-invalid');

            document.getElementById('mulai_tanggal').value = '';
            document.getElementById('sampai_tanggal').value = '';

            document.querySelector('.text-danger').style.display = 'none';
        });
    </script>
@endsection
