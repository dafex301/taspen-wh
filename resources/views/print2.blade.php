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
            <td>{ $laporan->Pelapor->name }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>nik</td>
        </tr>
        <tr>
            <td>Cabang</td>
            <td>:</td>
            <td>{ $laporan->cabang }}</td>
        </tr>
        <tr>
            <td>Tanggal Kejadian</td>
            <td>:</td>
            <td>{ $laporan->tanggal }}</td>
        </tr>
    </table>

    <p style="font-weight: 800">KESIMPULAN</p>
    <div style="border: 1px solid black; padding: 10px">
        <p style="font-weight: 800">Deskripsi Kejadian</p>
        <p>{ $laporan->deskripsi }}</p>
        <p style="font-weight: 800">Potensi Bahaya Kategori</p>
        <p>{ $laporan->kategori ? $laporan->Kategori->name : $laporan->kategori_lain }}</p>
        <p style="font-weight: 800">Evidence</p>
        <p>{{ storage_path('app\\public\\image/1679221570_Barcelona_Prof. Tobin Gutkowski.png') }}</p>
        {{-- <img src="/storage/image/1679221570_Barcelona_Prof. Tobin Gutkowski.png" alt="Responsive image"> --}}
        <img src="{{ url('storage/image/1677473996_Tembalang_Dr. Wellington Bailey.jpg') }}" alt="Responsive image">
    </div>
    <p style="font-weight: 800">TINDAK LANJUT</p>
    <div style="border: 1px solid black; padding: 10px">
        <p style="font-weight: 800">Tindakan</p>
        <p>{tindakan}</p>
        <p style="font-weight: 800">PIC</p>
        <p>{pic}</p>
        <p style="font-weight: 800">Batas Waktu</p>
        <p>{batas_waktu}</p>
        <p style="font-weight: 800">Evidence</p>
        <p>{evidence}</p>
    </div>
    <div style="text-align: right">
        <p>{cabang}, {completed_at}</p>
        <div style="height: 70px;"></div>
        <p>{completed_by}</p>
        <p>{nik}</p>
    </div>
    <p>Dicetak pada: { now() }}</p>

</body>

</html>
