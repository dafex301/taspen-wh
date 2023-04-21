@extends('layouts.main')

@section('container')
    <style type="text/css">
        @media print {
            .noprint {
                display: none;
            }

            .print {
                display: block !important;
            }
        }

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

        .print {
            display: none;
        }
    </style>

    <div class="container noprint">

        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <h3>Buat Pengadaan</h3>
                        <div>{{ $realisasi_pengadaan_date->format('d M Y') }}</div>
                    </div>

                    <button onclick="window.print()" class="btn btn-success noprint" style="height: 40px;">
                        Cetak
                    </button>
                </div>

                <div class="">

                    @foreach ($kategori as $k)
                        <?php $i = 1; ?>
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
                                    @foreach ($realisasi_pengadaan_detail as $key => $val)
                                        {{-- if item->kategori is equal to k index in kategori --}}
                                        @if ($val['kategori'] == $k)
                                            <tr>
                                                <td class="tg-baqh"> {{ $i++ }} </td>
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
                    @endforeach

                </div>




            </div>
        </div>
    </div>



    <div class="print">
        <header>
            <table>
                <tr>
                    <td>
                        <img src="{{ url('assets/img/taspen.png') }}" alt="" width="100"
                            style="margin-right: 20px;" />
                    </td>
                    <td>
                        <span style="font-weight: bold; font-size: large">PT. TASPEN (PERSERO)</span><br />
                        <span>Jl. Letjend Soeprapto No. 45 Cempaka Putih, Jakarta Pusat
                            10520</span>
                    </td>
                </tr>
            </table>
        </header>
        <br>
        <center>
            <h3>RESUME PENGADAAN</h3>
            {{-- No: RSM-id with 3 digits such as 002 --}}
            {{-- Date monthyear such as 042023 --}}
            <p>No: RSM-{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}/CU.04/{{ date('mY') }}</p>
        </center>

        @foreach ($kategori as $k)
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
                        @foreach ($realisasi_pengadaan_detail as $key => $val)
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
        @endforeach

        <div style="text-align: right">
            <p>Semarang, {{ $realisasi_pengadaan_date->format('d M Y') }}</p>
            <div style="height: 70px;"></div>
            <p>{{ $realisasi_pengadaan->penanggungJawab->nama }}</p>
            <p>{{ $realisasi_pengadaan->penanggungJawab->nik }}</p>
        </div>
        <p>Dicetak pada: {{ now() }}</p>
    </div>
@endsection
