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

        .print {
            display: none;
        }
    </style>

    {{-- Printing Style --}}
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }
    </style>


    <div class="container noprint">

        {{-- notification about lastPermintaan if route is /bidang/permintaan/verifikasi/{id} or /umum/permintaan/verifikasi/{id} --}}
        @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi') ||
                Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
            @if ($lastPermintaan)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Permintaan terakhir <strong>{{ $lastPermintaan->kegiatan }}</strong>
                    pada tanggal <strong>{{ $lastPermintaan->created_at->format('d M Y') }}</strong>
                    <ul>
                        @foreach ($lastItems as $i)
                            <li>{{ $i->nama }} ({{ $i->jumlah }} {{ $i->satuan }})</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endif

        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <h5>Detail Permintaan</h5>
                        <h3>{{ $permintaan->kegiatan }}</h3>
                        <div>{{ $permintaan->created_at->format('d M Y') }}</div>
                        <div>{{ $permintaan->Bidang->nama }}</div>
                        <div>{{ $permintaan->Pemohon->nama }}</div>
                    </div>
                    <button onclick="window.print()" class="btn btn-success noprint" style="height: 40px;">
                        Cetak
                    </button>
                </div>

                @foreach ($kategori as $k)
                    <h5 class="text-center">{{ $k }}</h5>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width: 5%">No</th>
                                <th scope="col" style="width: 50%">Barang</th>
                                <th scope="col">Jumlah</th>
                                @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi') ||
                                        Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
                                    <th scope="col">Stok Bidang</th>
                                    <th scope="col">Stok Keseluruhan</th>
                                @endif
                                <th scope="col">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $idx = 1; ?>
                            @foreach ($items as $i)
                                @if ($i->kategori === $k)
                                    <tr>
                                        <th scope="row">{{ $idx++ }}</th>
                                        <th scope="row">{{ $i->nama }}</th>
                                        <td scope="row">{{ $i->jumlah }}</td>
                                        @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi') ||
                                                Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
                                            <td scope="row">
                                                @if ($i->bidang === 1)
                                                    {{ $i->stok_bidang_layanan }}
                                                @elseif ($i->bidang === 2)
                                                    {{ $i->stok_bidang_keuangan }}
                                                @else
                                                    {{ $i->stok_bidang_umum }}
                                                @endif
                                            </td>
                                            <td scope="row">
                                                {{ $i->stok_bidang_layanan + $i->stok_bidang_umum + $i->stok_bidang_keuangan }}
                                            </td>
                                        @endif
                                        <td scope="row">{{ $i->satuan }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endforeach

                {{-- if path is start with 'bidang/permintaan/verifikasi/id' --}}
                @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi') ||
                        Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
                    <div class="d-flex justify-content-end">
                        <div>
                            <button class="btn btn-danger" id="tolak" data-bs-toggle="modal"
                                data-bs-target="#tolakModal">Tolak Permintaan</button>
                            @if ($permintaan->status_manager_umum === 0 && Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi'))
                                <a class="btn btn-warning" id="setuju"
                                    href="/bidang/permintaan/revisi/{{ $permintaan->id }}">Revisi Permintaan</a>
                            @else
                                <button class="btn btn-success" id="setuju" data-bs-toggle="modal"
                                    data-bs-target="#approveModal">Setujui Permintaan</button>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="print">
        <header>
            <table>
                <tr>
                    <td>
                        <img src="{{ url('assets/img/taspen.png') }}" alt="" width="100" />
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
            <h3 style="margin-top:10px;">RESUME PERMINTAAN</h3>
            {{-- No: RSM-id with 3 digits such as 002 --}}
            {{-- Date monthyear such as 042023 --}}
            <p>No: RSM-{{ str_pad($permintaan->id, 3, '0', STR_PAD_LEFT) }}/CU.04/{{ date('mY') }}</p>
        </center>
        <table>

            <tr>
                <td>Nama Kegiatan</td>
                <td>:</td>
                <td>{{ $permintaan->kegiatan }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $permintaan->Pemohon->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>NIK</td>
            </tr>
            <tr>
                <td>Bidang</td>
                <td>:</td>
                <td>{{ $permintaan->Bidang->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $permintaan->created_at->format('d M Y') }}</td>
            </tr>
            {{-- Spacing --}}
            <tr style="opacity: 0%">
                <td>Nama Kegiatann</td>
                <td>:::</td>
                <td>{{ $permintaan->kegiatan }}</td>
            </tr>
            {{-- End of Spacing --}}
        </table>

        @foreach ($kategori as $k)
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-baqh" colspan="4">{{ $k }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-baqh">No</td>
                        <td class="tg-baqh">Barang</td>
                        <td class="tg-baqh">Jumlah</td>
                        <td class="tg-baqh">Satuan</td>
                    </tr>
                    <?php $idx = 1; ?>
                    @foreach ($items as $i)
                        @if ($i->kategori === $k)
                            <tr>
                                <td class="tg-baqh">{{ $idx++ }}</td>
                                <td class="tg-0lax">{{ $i->nama }}</td>
                                <td class="tg-baqh">{{ $i->jumlah }}</td>
                                <td class="tg-baqh">{{ $i->satuan }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <div style="text-align: right; margin-top: 10px;">
            <p>Semarang, {{ date('d M Y', strtotime($permintaan->waktu_manager_umum)) }}</p>

            <div style="height: 70px;"></div>
            <p>{{ $permintaan->Manager_Umum->nama }}</p>
            <p>{{ $permintaan->Manager_Umum->nik }}</p>
        </div>
        <p>Dicetak pada: {{ now() }}</p>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveModalLabel">Approve Permintaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ url('assets/img/accept.jpeg') }}" alt="Approve" srcset=""
                        class="img-fluid w-25 mb-2">
                    <h5 class="text-center">Apakah anda yakin untuk <i>approve</i> permintaan ini?</h5>
                    <div id="approve-text"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi'))
                        <form action="/bidang/permintaan/verifikasi/{{ $permintaan->id }}" method="POST"
                            id="approve-laporan-form">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                    @elseif (Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
                        <form action="/umum/permintaan/verifikasi/{{ $permintaan->id }}" method="POST"
                            id="approve-laporan-form">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End of Approve Modal -->

    <!-- Tolak Modal -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi'))
                    <form action="/bidang/permintaan/reject/{{ $permintaan->id }}" method="post">
                    @elseif (Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
                        <form action="/umum/permintaan/reject/{{ $permintaan->id }}" method="post">
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
                        <h3 class="ms-2">Apakah anda yakin untuk menolak permintaan?</h3>
                    </div>
                    <div class="d-flex flex-column mt-2 text-center">
                        <label for="alasan">Alasan Ditolak*</label>
                        <input class="form-control mt-2" type="text" placeholder="Alasan" id="alasan" required
                            name="alasan">
                        <div class="text-danger text-sm" id="alasan-error"></div>
                    </div>
                    @if (Route::is('pengadaan.umum.verifikasi.detail') || Route::is('permintaan.umum.verifikasi.detail'))
                        <div class="d-flex flex-column mt-2 text-center">
                            <label for="alasan">Revisi</label>
                            <div>

                                <input type="radio" name="tujuan" id="manajer-bidang" required
                                    value="manajer-bidang">
                                <label for="manajer-bidang">
                                    Manajer
                                    Bidang
                                </label>

                                <input type="radio" name="tujuan" id="staff" class="ms-2" required
                                    value="staff"> <label for="staff">Staff</label>
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
