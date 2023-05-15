<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Table</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .description {
            border-collapse: collapse;
            border: none;
        }

        .description th,
        .description td {
            border: none;
        }

        .w-full {
            width: 100%;
        }
    </style>
</head>

<body>
    <div style="display: flex; justify-items: center; align-items: center">
        <img src="taspen.png" height="70" alt="Taspen" style="position: absolute" />
        <div style="width: 100%">
            <h3 style="text-align: center">DAFTAR PENGELUARAN BARANG</h3>
            <h3 style="text-align: center">(GOOD ISSUE)</h3>
        </div>
    </div>
    <center>
        <table border="0" class="description w-full">
            <tbody>
                <tr>
                    <td>Tanggal Doc.</td>
                    <td>:</td>
                    <td>08.05.2023</td>
                    <td></td>
                    <td>Nama Penerima</td>
                    <td>:</td>
                    <td>Budi</td>
                </tr>
                <tr>
                    <td>Tanggal Posting</td>
                    <td>:</td>
                    <td>08.05.2023</td>
                    <td></td>
                    <td>Cost Center</td>
                    <td>:</td>
                    <td>C-A400-000</td>
                </tr>
                <tr>
                    <td>Plant</td>
                    <td>:</td>
                    <td>A400</td>
                    <td></td>
                    <td>No Reservation</td>
                    <td>:</td>
                    <td>0040005001</td>
                </tr>
            </tbody>
        </table>
        <hr style="margin: 25px 0" />
        <table border="1" style="width: 100%">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">JENIS BARANG</th>
                    <th colspan="2">JUMLAH PERMINTAAN</th>
                    <th colspan="2">JUMLAH YANG DIKELUARKAN</th>
                    <th rowspan="2">KETERANGAN</th>
                </tr>
                <tr>
                    <th>JUMLAH</th>
                    <th>SATUAN</th>
                    <th>JUMLAH</th>
                    <th>SATUAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nama Barang</td>
                    <td>10</td>
                    <td>pcs</td>
                    <td>10</td>
                    <td>pcs</td>
                    <td>yey</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Barang</td>
                    <td>10</td>
                    <td>pcs</td>
                    <td>10</td>
                    <td>pcs</td>
                    <td>yey</td>
                </tr>
            </tbody>
        </table>

        <table style="margin-top: 50px; width: 100%; text-align: center" class="description">
            <tbody>
                <tr>
                    <td>SETUJU DIBERIKAN</td>
                    <td>SETUJU DIBERIKAN</td>
                    <td>YANG MENGAJUKAN</td>
                </tr>
                <tr>
                    <td>HC &amp; GA Sect Head</td>
                    <td>Services Sector Head</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 50px 0"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>(RR Ratri Feminingrum)</td>
                    <td>(Maizirwan)</td>
                    <td>(Anantian Suryo Utomo)</td>
                </tr>
                <tr>
                    <td style="padding: 10px"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>YANG MENERIMA</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding: 50px 0"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>(Anantian Suryo Utomo)</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </center>
</body>

</html>
