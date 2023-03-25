@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    @if ($laporan->pic_rejected)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Peringatan!</strong> Laporan ini ditolak oleh PIC
                            <br>
                            <strong>Alasan:</strong>
                            {{ $laporan->pic_rejected_reason }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($laporan->bm_rejected)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Peringatan!</strong> Laporan ini ditolak oleh BM
                            <br>
                            <strong>Alasan:</strong>
                            {{ $laporan->bm_rejected_reason }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($laporan->dpnp_rejected)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Peringatan!</strong> Laporan ini ditolak oleh DPnP
                            <br>
                            <strong>Alasan:</strong>
                            {{ $laporan->dpnp_rejected_reason }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card mb-4">
                        <div class="card-header"><strong>Detail Potensi Bahaya</strong></div>
                        <form action="/detail/{{ $laporan->id }}" method="post" enctype="multipart/form-data"
                            id="verifikasi-laporan-form">
                            @csrf
                            <div class="card-body">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-719">
                                        <div class="mb-3">
                                            <label class="form-label" for="pelapor">Pelapor</label>
                                            <input class="form-control" id="pelapor" type="text" name="pelapor"
                                                disabled value="{{ $laporan->Pelapor->name }}">
                                            @error('pelapor')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="verifyTanggal">Hari dan Tanggal</label>
                                            <input class="form-control" id="verifyTanggal" type="date" name="tanggal"
                                                placeholder="" value="{{ old('tanggal') ?? ($laporan->tanggal ?? '') }}"
                                                name="tanggal" disabled>
                                            @error('tanggal')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="lokasi">Lokasi</label>
                                            <input class="form-control" id="lokasi" type="text" name="lokasi"
                                                placeholder="" value="{{ old('lokasi') ?? ($laporan->lokasi ?? '') }}"
                                                @if (Str::startsWith(Request::path(), 'bm/laporan')) disabled @endif>
                                            @error('lokasi')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="jenis">Jenis / Kategori Potensi
                                                Bahaya</label>
                                            <select class="form-select" aria-label="jenis" id="jenis" name="kategori"
                                                @if (Str::startsWith(Request::path(), 'bm/laporan')) disabled @endif>
                                                <option value="">Pilih Jenis / Kategori</option>
                                                {{-- Foreach kategori --}}
                                                @foreach ($kategori as $item)
                                                    @if (old('kategori') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @elseif ($laporan->kategori == $item->id)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                                {{-- End Foreach --}}
                                            </select>
                                            @error('kategori')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="jenis-lain-container" style="display: none">
                                            <label class="form-label" for="jenis-lain">Jenis / Kategori</label>
                                            <input class="form-control" name="kategori_lain" id="jenis-lain" type="text"
                                                @if (Str::startsWith(Request::path(), 'bm/laporan')) disabled @endif placeholder=""
                                                value="{{ old('kategori_lain') ?? ($laporan->kategori_lain ?? '') }}">
                                            @error('kategori_lain')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="deskripsi">Deskripsi</label>
                                            <input class="form-control" id="deskripsi" type="text" placeholder=""
                                                name="deskripsi"
                                                value="{{ old('deskripsi') ?? ($laporan->deskripsi ?? '') }}"
                                                @if (Str::startsWith(Request::path(), 'bm/laporan')) disabled @endif>
                                            @error('deskripsi')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Dokumentasi</label>
                                            <div class="img-container mb-2"><img src="/storage/{{ $laporan->image }}"
                                                    alt="Dokumentasi" class="img-fluid col-lg-8" srcset=""></div>
                                            @if ($laporan->pic_rejected || $laporan->branch_manager_rejected || $laporan->dpnp_rejected)
                                                <input type="file" id="dokumentasi" class="form-control"
                                                    accept="image/*" capture="camera" value="{{ old('image') }}"
                                                    name="image">
                                            @endif
                                            @error('image')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" hidden id="verifikasi-laporan-submit">Tutup
                                            Laporan</button>

                                        @if (Str::startsWith(Request::path(), 'pic/laporan') || Str::startsWith(Request::path(), 'dpnp/laporan'))
                                            <div class="mb-3">
                                                <label class="form-label" for="immediate_action">Immediate Action</label>
                                                <input class="form-control" id="immediate_action" name="immediate_action"
                                                    type="text" placeholder=""
                                                    value="{{ old('immediate_action') ?? ($laporan->immediate_action ?? '') }}">
                                                <div class="text-danger" id="immediate_action-error"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="prevention">Pencegahan / Perbaikan</label>
                                                <input class="form-control" id="prevention" name="prevention"
                                                    type="text" placeholder=""
                                                    value="{{ old('prevention') ?? ($laporan->prevention ?? '') }}">
                                                <div class="text-danger" id="prevention-error"></div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="completed-image">Evidence Pencegahan /
                                                    Perbaikan</label>
                                                <div class="img-container-2 mb-2"></div>
                                                <input type="file" id="completed-image" name="completed_image"
                                                    class="form-control" accept="image/*" capture="camera">
                                                <div class="text-danger" id="completed_image-error"></div>
                                            </div>
                                        @endif

                                        <div class="mb-3 mt-4">
                                            @if (Str::startswith(Request::path(), 'pic/laporan') || Str::startswith(Request::path(), 'dpnp/laporan'))
                                                <button class="btn btn-success " type="button" data-bs-toggle="modal"
                                                    data-bs-target="#tutupModal">Tutup
                                                    Laporan</button>
                                            @endif
                                            @if (Str::startswith(Request::path(), 'pic/laporan'))
                                                <button class="btn btn-warning " type="button" data-bs-toggle="modal"
                                                    data-bs-target="#tindakModal">Tindak
                                                    Lanjut</button>
                                            @endif
                                            @if (Str::contains(Request::path(), 'revisi'))
                                                <button class="btn btn-success " type="button" data-bs-toggle="modal"
                                                    data-bs-target="#revisiModal">Revisi
                                                    Laporan</button>
                                            @endif
                                            @if (Str::startswith(Request::path(), 'bm/laporan'))
                                                <button class="btn btn-success " type="button" data-bs-toggle="modal"
                                                    data-bs-target="#approveModal">Approve
                                                    Laporan</button>
                                            @endif
                                            @if (Str::contains(Request::path(), '/laporan'))
                                                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#tolakModal">Tolak
                                                    Laporan</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tutup Modal -->
    <div class="modal fade" id="tutupModal" tabindex="-1" aria-labelledby="tutupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tutupModalLabel">Tutup Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="cancelModal"></button>
                </div>
                <div class="modal-body ">
                    <div class="d-flex align-items-center">
                        <img src="{{ url('assets/img/accept.jpeg') }}" alt="" srcset="" class="w-25">
                        <h3 class="ms-2">Apakah anda yakin untuk menutup laporan?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="tutup-laporan">Tutup
                        Laporan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Tutup Modal -->

    <!-- Tindaklanjuti Modal -->
    <div class="modal fade" id="tindakModal" tabindex="-1" aria-labelledby="tindakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tindakModalLabel">Tindak Lanjut</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ url('assets/img/tindaklanjut.jpeg') }}" alt="" srcset=""
                            class="w-25">
                        <h3 class="ms-3">Apakah anda yakin untuk tindak lanjut laporan?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-warning" id="tindak-lanjut">Tindak Lanjut</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Tindaklanjuti Modal -->

    <!-- Tolak Modal -->
    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="TolakModalLabel">Tolak Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="cancelModal"></button>
                </div>
                <div class="modal-body ">
                    <div class="d-flex align-items-center">
                        <img src="{{ url('assets/img/warning.webp') }}" alt="Warning" srcset="" class="w-25">
                        <h3 class="ms-2">Apakah anda yakin untuk menolak laporan?</h3>
                    </div>
                    <div class="d-flex flex-column mt-2 text-center">
                        <label for="alasan">Alasan Ditolak*</label>
                        <input class="form-control mt-2" type="text" placeholder="Alasan" id="alasan">
                        <div class="text-danger text-sm" id="alasan-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="tolak-laporan">Tolak
                        Laporan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Tolak Modal -->

    {{-- Revisi Modal --}}
    <div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="revisiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="revisiModalLabel">Revisi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ url('assets/img/tindaklanjut.jpeg') }}" alt="" srcset=""
                            class="w-25">
                        <h3 class="ms-3">Apakah anda yakin untuk merevisi laporan?</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="revisi">Revisi</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Revisi Modal --}}

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="approveModalLabel">Approve Laporan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ url('assets/img/accept.jpeg') }}" alt="Approve" srcset=""
                        class="img-fluid w-25 mb-2">
                    <h5 class="text-center">Apakah anda yakin untuk <i>approve</i> laporan ini?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/approve/{{ $laporan->id }}" method="POST" id="approve-laporan-form">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Approve Modal -->

    {{-- Script --}}
    <script defer>
        // Tutup Laporan Validation
        $('#tutup-laporan').click(function() {
            if ($('#immediate_action').val() == '') {
                $('#immediate_action-error').html('Harap isi immediate action');
            } else {
                $('#immediate_action-error').html('');
            }
            if ($('#prevention').val() == '') {
                $('#prevention-error').html('Harap isi langkah pencegahan');
            } else {
                $('#prevention-error').html('');
            }
            if ($('#completed_image').val() == '') {
                $('#completed_image-error').html('Harap masukkan dokumentasi');
            } else {
                $('#completed_image-error').html('');
            }
            if ($('#immediate_action').val() != '' && $('#prevention').val() != '' && $('#completed_image').val() !=
                '') {
                $('#verifikasi-laporan-submit').click();
            }
            $('#cancelModal').click();
        });

        $('#tindak-lanjut').click(function() {
            $('#verifikasi-laporan-form').attr('action',
                "{{ route('laporan.tindaklanjut', $laporan->id) }}");
            $('#verifikasi-laporan-submit').click();
            $('#cancelModal').click();
        });

        $('#tolak-laporan').click(function() {
            if ($('#alasan').val() == '') {
                $('#alasan-error').html('Harap isi alasan');
            } else {
                $('#alasan-error').html('');
            }
            if ($('#alasan').val() != '') {
                $('#verifikasi-laporan-form').attr('action',
                    "{{ route('laporan.reject', $laporan->id) }}");
                $('#verifikasi-laporan-form').append('<input type="hidden" name="reason" value="' + $('#alasan')
                    .val() + '">');
                $('#verifikasi-laporan-submit').click();
            }
            $('#cancelModal').click();
        });

        $('#revisi').click(function() {
            $('#verifikasi-laporan-form').attr('action',
                "{{ route('laporan.revisi', $laporan->id) }}");
            $('#verifikasi-laporan-submit').click();
            $('#cancelModal').click();
        });
    </script>



    {{-- Script --}}
@endsection
