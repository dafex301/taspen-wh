<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan</title>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-color: #ccc;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            background-color: #fff;
            border-color: #ccc;
            border-style: solid;
            border-width: 1px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            background-color: #f0f0f0;
            border-color: #ccc;
            border-style: solid;
            border-width: 1px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-yj5y {
            background-color: #efefef;
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-7fle {
            background-color: #efefef;
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-9wq8 {
            border-color: inherit;
            text-align: center;
            vertical-align: middle
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-c3ow {
            border-color: inherit;
            text-align: center;
            vertical-align: top
        }

        .tg .tg-wp8o {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }

        .tg .tg-amwm {
            font-weight: bold;
            text-align: center;
            vertical-align: top
        }
    </style>
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
        {{-- No: RSM-id with 3 digits such as 002 --}}
        {{-- Date monthyear such as 042023 --}}
        <p>No: RSM-{{ str_pad($laporan->id, 3, '0', STR_PAD_LEFT) }}/CU.04/{{ date('mY') }}</p>
    </center>
    <div class="mb-5">
        <h5 class="text-center">Kategori {{ $k }}</h5>

        <table class="tg">
            <thead>
                <tr>
                    <th class="tg-9wq8" rowspan="2">No</th>
                    <th class="tg-9wq8" rowspan="4">Nama Barang</th>
                    <th class="tg-c3ow" colspan="4">Jumlah</th>
                    <th class="tg-9wq8" rowspan="2">Satuan</th>
                </tr>
                <tr>
                    <th class="tg-yj5y">Layanan</th>
                    <th class="tg-yj5y">Keuangan</th>
                    <th class="tg-yj5y">Umum</th>
                    <th class="tg-7fle">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($realisasi_pengadaan as $key => $val)
                    {{-- if item->kategori is equal to k index in kategori --}}
                    @if ($val['kategori'] == $k)
                        <tr>
                            <td class="tg-baqh"> {{ $loop->iteration }} </td>
                            <td class="tg-0lax"> {{ $key }}</td>
                            <td class="tg-baqh"> {{ $val['bidang'][1] ?? 0 }} </td>
                            <td class="tg-baqh"> {{ $val['bidang'][2] ?? 0 }} </td>
                            <td class="tg-baqh"> {{ $val['bidang'][3] ?? 0 }} </td>
                            {{-- total of bidang 1 2 3 --}}
                            <td class="tg-amwm">
                                {{ ($val['bidang'][1] ?? 0) + ($val['bidang'][2] ?? 0) + ($val['bidang'][3] ?? 0) }}
                            </td>

                            <td class="tg-wp8o"> {{ $val['satuan'] }} </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
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
