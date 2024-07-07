<table>
    <thead>
        <tr>
            <th style="width: 25px; text-align: center;">No.</th>
            <th style="width: 150px; text-align: center;">Hari, Tanggal Pengajuan</th>
            <th style="width: 100px; text-align: center;">Nama Karyawan</th>
            <th style="width: 100px; text-align: center;">Jenis Alat Berat</th>
            <th style="width: 60px; text-align: center;">Jumlah</th>
            <th style="width: 510px; text-align: center;">Alasan</th>
            <th style="width: 360px; text-align: center;">Status</th>
            <th style="width: 270px; text-align: center;">Nama Admin (menolak/menyetujui)</th>
            <th style="width: 280px; text-align: center;">Nama Direktur (menolak/menyetujui)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->translatedFormat('l, d F Y') }}</td>
                <td>{{ $data->user->nama }}</td>
                <td>{{ $data->jenis_alat_berat }}</td>
                <td style="text-align: left;">{{ $data->jumlah }}</td>
                <td>{{ $data->alasan }}</td>
                <td>
                    @if ($data->status == 'tunggu')
                        Menunggu, Belum Disetujui Admin dan Direktur
                    @elseif ($data->status == 'disetujui_admin')
                        Disetujui Admin, belum disetujui Direktur
                    @elseif ($data->status == 'ditolak_admin')
                        Ditolak Admin
                    @elseif ($data->status == 'disetujui_direktur')
                        Disetujui Admin, Disetujui Direktur
                    @elseif ($data->status == 'ditolak_direktur')
                        Disetujui Admin, Ditolak Direktur
                    @endif
                </td>
                <td>
                    @if (is_null($data->status))
                        Null
                    @elseif ($data->status == 'disetujui_admin' || $data->status == 'ditolak_admin' || $data->status == 'disetujui_direktur' || $data->status == 'ditolak_direktur')
                        {{ $data->admin->nama }}
                    @endif
                </td>
                <td>
                    @if (is_null($data->status))
                        Null
                    @elseif ($data->status == 'disetujui_direktur' || $data->status == 'ditolak_direktur')
                        {{ $data->direktur->nama }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
