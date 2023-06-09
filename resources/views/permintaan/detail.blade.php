@extends('layouts.main')

@section('container')
    <style type="text/css">
        @media print {
            .noprint {
                display: none;
            }

            .print {
                display: block !important;
                font-family: 'Times New Roman', Times, serif;
            }

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
        }

        .print {
            display: none;
        }
    </style>


    <div class="container noprint">

        {{-- notification about lastPermintaan if route is /bidang/permintaan/verifikasi/{id} or /umum/permintaan/verifikasi/{id} --}}
        @if (Str::startsWith(request()->path(), 'bidang/permintaan/verifikasi') ||
                Str::startsWith(request()->path(), 'umum/permintaan/verifikasi'))
            @if (isset($lastPermintaan))
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
                    @if ($permintaan->status_manager_umum === 1)
                        <button onclick="window.print()" class="btn btn-success noprint" style="height: 40px;">
                            Cetak
                        </button>
                    @endif
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


    {{-- if permintaan is complete --}}
    @if ($permintaan->status_manager_umum === 1)
        <div class="print">
            <header style="display: flex; justify-items: center; align-items: center">
                <img src="{{ url('assets/img/taspen.png') }}" alt="" width="100" style="position: absolute" />
                <div style="width: 100%">
                    <h4 style="text-align: center">DAFTAR PENGELUARAN BARANG</h4>
                    <h4 style="text-align: center">(GOOD ISSUE)</h4>
                </div>
            </header>
            <center>
                <table border="0" class="description w-full">
                    <tbody>
                        <tr>
                            <td>Tanggal Doc.</td>
                            <td>:</td>
                            <td>{{ date('d.m.Y') }}</td>
                            <td></td>
                            <td>Nama Penerima</td>
                            <td>:</td>
                            <td>{{ $permintaan->Pemohon->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Posting</td>
                            <td>:</td>
                            <td>{{ $permintaan->created_at->format('d.m.Y') }}</td>
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
                            <td>{{ $permintaan->created_at->format('Ymd') . str_pad($permintaan->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
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
                            <th style="text-align: center">JUMLAH</th>
                            <th style="text-align: center">SATUAN</th>
                            <th style="text-align: center">JUMLAH</th>
                            <th style="text-align: center">SATUAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $i)
                            <tr>
                                {{-- Get the loop iterations+1 --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->nama }}</td>
                                <td style="text-align: center;">{{ $i->jumlah }}</td>
                                <td style="text-align: center;">{{ $i->satuan }}</td>
                                <td style="text-align: center;">{{ $i->jumlah }}</td>
                                <td style="text-align: center;">{{ $i->satuan }}</td>
                                <td></td>
                            </tr>
                        @endforeach
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
                            <td>
                                <span>
                                    @if ($permintaan->bidang === 1)
                                        Services Sector
                                    @elseif ($permintaan->bidang === 2)
                                        Finance Sector
                                    @elseif ($permintaan->bidang === 3)
                                        HC & GA Section
                                    @endif
                                </span>
                                <span>Head</span>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="padding: 50px 0"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>({{ $permintaan->Manager_Umum->nama }})</td>
                            <td>({{ $permintaan->Manager_Bidang->nama }})</td>
                            <td>({{ $permintaan->Pemohon->nama }})</td>
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
                            <td>({{ $permintaan->Pemohon->nama }})</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
    @endif

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
