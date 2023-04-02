@extends('layouts.main')

@section('container')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <h3>{{ $pengadaan->kegiatan }}</h3>
                        <div>{{ $pengadaan->created_at->format('d M Y') }}</div>
                        <div>{{ $pengadaan->Bidang->nama }}</div>
                        <div>{{ $pengadaan->Pemohon->nama }}</div>
                    </div>
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

                                <input type="radio" name="tujuan" id="manajer-bidang" required value="manajer-bidang">
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
