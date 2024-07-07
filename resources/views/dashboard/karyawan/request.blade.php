@extends('partials.app')

@section('title', 'Dashboard - Karyawan')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengajuan Surat Pembelian Alat Berat</h1>
    <p class="mb-4"></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('karyawan.storeRequest') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Alat Berat</label>
                    <input type="text" class="form-control @error('jenis_alat_berat') is-invalid @enderror"
                        id="exampleFormControlInput1" name="jenis_alat_berat" placeholder="Masukkan Jenis Alat Berat"
                        value="{{ old('jenis_alat_berat') }}">
                    @error('jenis_alat_berat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                        id="exampleFormControlInput2" name="jumlah" placeholder="Masukkan Jumlah Alat Berat" min="1" max="50"
                        value="{{ old('jumlah') }}">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alasan Pembelian</label>
                    <textarea class="form-control  @error('alasan') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3"
                        name="alasan">{{ old('alasan') }}</textarea>
                    @error('alasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
