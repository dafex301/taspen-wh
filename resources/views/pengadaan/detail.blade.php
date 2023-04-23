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
        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <h5>Detail Pengadaan</h5>
                        <h3>{{ $pengadaan->kegiatan }}</h3>
                        <div>{{ $pengadaan->created_at->format('d M Y') }}</div>
                        <div>{{ $pengadaan->Bidang->nama }}</div>
                        <div>{{ $pengadaan->Pemohon->nama }}</div>
                    </div>
                    @if ($pengadaan->selesai)
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
                                <th scope="col" style="width: 70%">Barang</th>
                                <th scope="col">Jumlah</th>
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
                                        <td scope="row">{{ $i->satuan }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endforeach

                {{-- if path is start with 'bidang/pengadaan/verifikasi/id' --}}
                @if (Str::startsWith(request()->path(), 'bidang/pengadaan/verifikasi') ||
                        Str::startsWith(request()->path(), 'umum/pengadaan/verifikasi'))
                    <div class="d-flex justify-content-end">
                        <div>
                            <button class="btn btn-danger" id="tolak" data-bs-toggle="modal"
                                data-bs-target="#tolakModal">Tolak Pengadaan</button>
                            <button class="btn btn-success" id="setuju" data-bs-toggle="modal"
                                data-bs-target="#approveModal">Setujui Pengadaan</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($pengadaan->selesai)
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
                <h3 style="margin-top:10px;">RESUME PENGADAAN</h3>
                {{-- No: RSM-id with 3 digits such as 002 --}}
                {{-- Date monthyear such as 042023 --}}
                <p>No: RSM-{{ str_pad($pengadaan->id, 3, '0', STR_PAD_LEFT) }}/CU.04/{{ date('mY') }}</p>
            </center>
            <table>

                <tr>
                    <td>Nama Kegiatan</td>
                    <td>:</td>
                    <td>{{ $pengadaan->kegiatan }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $pengadaan->Pemohon->nama }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>NIK</td>
                </tr>
                <tr>
                    <td>Bidang</td>
                    <td>:</td>
                    <td>{{ $pengadaan->Bidang->nama }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ $pengadaan->created_at->format('d M Y') }}</td>
                </tr>
                {{-- Spacing --}}
                <tr style="opacity: 0%">
                    <td>Nama Kegiatann</td>
                    <td>:::</td>
                    <td>{{ $pengadaan->kegiatan }}</td>
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
                <p>Semarang, {{ date('d M Y', strtotime($pengadaan->waktu_manager_umum)) }}</p>

                <div style="height: 70px;"></div>
                <p>{{ $pengadaan->Manager_Umum->nama }}</p>
                <p>{{ $pengadaan->Manager_Umum->nik }}</p>
            </div>
            <p>Dicetak pada: {{ now() }}</p>
        </div>
    @endif

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveModalLabel">Approve Pengadaan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ url('assets/img/accept.jpeg') }}" alt="Approve" srcset=""
                        class="img-fluid w-25 mb-2">
                    <h5 class="text-center">Apakah anda yakin untuk <i>approve</i> pengadaan ini?</h5>
                    <div id="approve-text"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if (Str::startsWith(request()->path(), 'bidang/pengadaan/verifikasi'))
                        <form action="/bidang/pengadaan/verifikasi/{{ $pengadaan->id }}" method="POST"
                            id="approve-laporan-form">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                    @elseif (Str::startsWith(request()->path(), 'umum/pengadaan/verifikasi'))
                        <form action="/umum/pengadaan/verifikasi/{{ $pengadaan->id }}" method="POST"
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
