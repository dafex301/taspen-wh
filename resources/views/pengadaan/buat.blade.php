@extends('layouts.main')

@section('container')
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

    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <h3>Buat Pengadaan</h3>
                        <div>{{ now()->format('d M Y') }}</div>
                    </div>
                </div>
                @foreach ($itemPengadaan as $k => $i)
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
                                @foreach ($i as $item)
                                    <tr>
                                        <td class="tg-baqh">{{ $loop->iteration }}</td>
                                        <td class="tg-0lax">{{ $item['nama_item'] }}</td>
                                        <td class="tg-baqh">{{ $item['Bidang Layanan dan Kepesertaan'] }}</td>
                                        <td class="tg-baqh">{{ $item['Bidang Keuangan'] }}</td>
                                        <td class="tg-baqh">{{ $item['Bidang Umum dan SDM'] }}</td>
                                        <td class="tg-amwm">{{ $item['total'] }}</td>
                                        <td class="tg-wp8o">{{ $item['satuan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

                <div class="d-flex justify-content-end">
                    <div>

                        <button class="btn btn-success" id="setuju" data-bs-toggle="modal"
                            data-bs-target="#approveModal">Buat Pengadaan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveModalLabel">Buat Pengadaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ url('assets/img/accept.jpeg') }}" alt="Approve" srcset=""
                        class="img-fluid w-25 mb-2">
                    <h5 class="text-center">Apakah anda yakin untuk <i>buat</i> pengadaan ini?</h5>
                    <div id="approve-text"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/umum/pengadaan/approval/create" method="POST" id="approve-laporan-form">
                        @csrf
                        <button type="submit" class="btn btn-success">Buat</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Approve Modal -->

    <!-- Tolak Modal -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @if (Str::startsWith(request()->path(), 'bidang/pengadaan/verifikasi'))
                    <form action="/bidang/pengadaan/reject/{{ $pengadaan->id }}" method="post">
                    @elseif (Str::startsWith(request()->path(), 'umum/pengadaan/verifikasi'))
                        <form action="/umum/pengadaan/reject/{{ $pengadaan->id }}" method="post">
                @endif
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="TolakModalLabel">Tolak Pengadaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="cancelModal"></button>
                </div>
                <div class="modal-body ">
                    <div class="d-flex align-items-center">
                        <img src="{{ url('assets/img/warning.webp') }}" alt="Warning" srcset="" class="w-25">
                        <h3 class="ms-2">Apakah anda yakin untuk menolak pengadaan?</h3>
                    </div>
                    <div class="d-flex flex-column mt-2 text-center">
                        <label for="alasan">Alasan Ditolak*</label>
                        <input class="form-control mt-2" type="text" placeholder="Alasan" id="alasan" required
                            name="alasan">
                        <div class="text-danger text-sm" id="alasan-error"></div>
                    </div>
                    @if (Route::is('pengadaan.umum.verifikasi.detail'))
                        <div class="d-flex flex-column mt-2 text-center">
                            <label for="alasan">Revisi</label>
                            <div>

                                <input type="radio" name="tujuan" id="manajer-bidang" required value="manajer-bidang">
                                <label for="manajer-bidang">
                                    Manajer
                                    Bidang
                                </label>

                                <input type="radio" name="tujuan" id="staff" class="ms-2" required
                                    value="staff">
                                <label for="staff">Staff</label>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="tolak-laporan">Tolak
                    </button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End of Tolak Modal -->
@endsection
