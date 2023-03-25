@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Laporan Potensi Bahaya</strong></div>
                        <form action="" method="post">

                            <div class="card-body">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane active preview" role="tabpanel" id="preview-719">
                                        <table class="table table-hover" id="myTable">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Deskripsi</th>
                                                    <th scope="col">Hari, Tanggal</th>
                                                    <th scope="col">Lokasi</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">Pelapor</th>
                                                    <th scope="col">Alasan Ditolak</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Foreach laporan --}}
                                                @foreach ($laporan as $l)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <th scope="row">{{ $l->deskripsi }}</th>
                                                        <td>{{ \Carbon\Carbon::parse($l->tanggal)->locale('id')->isoFormat('dddd, D/MM/YYYY') }}
                                                        </td>

                                                        <td>{{ $l->lokasi }}</td>
                                                        @if ($l->kategori === 0)
                                                            <td>{{ $l->kategori_lain }}</td>
                                                        @else
                                                            <td>{{ $l->Kategori->name }}</td>
                                                        @endif
                                                        <td>{{ $l->Pelapor->name }}</td>

                                                        @if (auth()->user()->Role->name === 'PIC')
                                                            <td>{{ $l->branch_manager_rejected_reason ?? ($l->dpnp_rejected_reason ?? '-') }}
                                                            </td>
                                                        @elseif (auth()->user()->Role->name === 'BM')
                                                            <td>{{ $l->dpnp_rejected_reason ?? '-' }}</td>
                                                        @endif
                                                        <td>
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                                                data-bs-whatever="{{ $l->image }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" strokeWidth={1.5}
                                                                    stroke="currentColor" style="height: 20px;">
                                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                                </svg>
                                                            </button>
                                                            <a href="/revisi/{{ $l->id }}"
                                                                class="btn btn-outline-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                                </svg>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="imageModalLabel">Dokumentasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Image Modal -->

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
                    <div id="approve-text"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="" method="POST" id="approve-laporan-form">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Approve Modal -->



    {{-- Approve Modal Script --}}
    <script>
        $('#approveModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var deskripsi = button.data('deskripsi')
            var lokasi = button.data('lokasi')
            var tanggal = button.data('tanggal')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // Create a h6 for every deskripsi, lokasi, and tanggal in div approve-text id and clear it first
            $('#approve-text').empty()
            $('#approve-text').append('<h6 class="text-center">Deskripsi: ' + deskripsi + '</h6>')
            $('#approve-text').append('<h6 class="text-center">Lokasi: ' + lokasi + '</h6>')
            $('#approve-text').append('<h6 class="text-center">Tanggal: ' + tanggal + '</h6>')

            // Set the action of approve-laporan-form to /approve/{id}
            $('#approve-laporan-form').attr('action', '/approve/' + id)
        })
    </script>
    {{-- End of Approve Modal Script --}}
@endsection
