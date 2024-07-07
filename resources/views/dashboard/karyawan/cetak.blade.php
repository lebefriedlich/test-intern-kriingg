<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Persetujuan Permintaan Alat Berat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature p {
            text-align: center;
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };

        window.onafterprint = function() {
            window.location.href = "/karyawan";
        };

        document.onkeydown = function(event) {
            if (event.keyCode === 27) {
                window.location.href = "/karyawan";
            }
        };
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Surat Persetujuan Pembelian Alat Berat</h2>
        </div>
        <div class="content">
            <p>Pada hari <strong>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->translatedFormat('l, d F Y') }}</strong>,
                kami yang bertanda tangan di bawah ini:</p>
            <p>Nama Pengaju: <strong>{{ $data->user->nama }}</strong></p>
            <p>Telah mengajukan permohonan untuk pembelian alat berat dengan detail sebagai berikut:</p>
            <p>Jenis Alat Berat: <strong>{{ $data->jenis_alat_berat }}</strong></p>
            <p>Jumlah: <strong>{{ $data->jumlah }}</strong></p>
            <p>Alasan Penggunaan: <strong>{{ $data->alasan }}</strong></p>
        </div>
        <div class="signature">
            <div class="admin">
                <p>Disetujui oleh:</p>
                <br><br>
                <p>{{ $data->admin->nama }}</p>
            </div>
            <div class="director">
                <p>Disetujui oleh:</p>
                <br><br>
                <p>{{ $data->direktur->nama }}</p>
            </div>
        </div>
    </div>
</body>

</html>
