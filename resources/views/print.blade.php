<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan</title>
</head>

<body>
    <header>
        <table>
            <tr>
                <td>
                    <img src="{{ url('assets/img/taspen.png') }}" alt="" height="60" />
                </td>
                <td>
                    <span style="font-weight: bold; font-size: large">PT. TASPEN (PERSERO)</span><br />
                    <span>Jl. Letjend Soeprapto No. 45 Cempaka Putih, Jakarta Pusat
                        10520</span>
                </td>
            </tr>
        </table>
    </header>
    <center>
        <h3>RESUME PELAPORAN</h3>
        <p>No: .......................</p>
    </center>
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $laporan->Pelapor->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $laporan->Pelapor->nik }}</td>
        </tr>
        <tr>
            <td>Cabang</td>
            <td>:</td>
            <td>{{ $laporan->Cabang->name }}, {{ $laporan->completed_at }}</td>

        </tr>
        <tr>
            <td>Tanggal Kejadian</td>
            <td>:</td>
            <td>{{ $laporan->tanggal }}</td>
        </tr>
    </table>

    <p style="font-weight: 800">KESIMPULAN</p>
    <div style="border: 1px solid black; padding: 10px">
        <p style="font-weight: 800">Deskripsi Kejadian</p>
        <p>{{ $laporan->deskripsi }}</p>
        <p style="font-weight: 800">Potensi Bahaya Kategori</p>
        <p>{{ $laporan->kategori ? $laporan->Kategori->name : $laporan->kategori_lain }}</p>
        <p style="font-weight: 800">Evidence</p>
        <img src="{{ url('storage/' . $laporan->image) }}" alt="Evidence" height="200px">
    </div>
    <p style="font-weight: 800">TINDAK LANJUT</p>
    <div style="border: 1px solid black; padding: 10px">
        <p style="font-weight: 800">Immediate Action</p>
        <p>{{ $laporan->immediate_action }}</p>
        <p style="font-weight: 800">Prevention</p>
        <p>{{ $laporan->prevention }}</p>
        <p style="font-weight: 800">Evidence</p>
        <img src="{{ url('storage/' . $laporan->completed_image) }}" alt="Evidence" height="200px">
    </div>
    <div style="text-align: right">
        <p>{{ $laporan->Cabang->name }}, {{ $laporan->completed_at }}</p>
        <div style="height: 70px;"></div>
        <p>{{ $laporan->Completed_By->name }}</p>
        <p>{{ $laporan->Completed_By->nik }}</p>
    </div>
    <p>Dicetak pada: {{ now() }}</p>

    {{-- Print when page is loaded --}}
    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>

</html>
