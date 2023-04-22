@extends('layouts.main')

@section('container')
    <form action="/umum/stok" method="POST">
        @csrf
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">

                <div class="row">
                    <div class="col-12">
                        <div class="card p-4 mb-4">
                            <h3 class="text-center">Input Stok</h3>
                            <table class="table table-hover" id="">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Stok Layanan</th>
                                        <th scope="col">Stok Keuangan</th>
                                        <th scope="col">Stok Umum</th>
                                        <th scope="col">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <input name="id[]" hidden type="text" value="{{ $item->id }}">
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <th>{{ $item->nama }}</th>
                                            <td>{{ $item->Kategori->nama }}</td>
                                            {{-- <td>{{ $item->stok_bidang_keuangan }}</td> --}}
                                            {{-- <td>{{ $item->stok_bidang_layanan }}</td> --}}
                                            {{-- <td>{{ $item->stok_bidang_umum }}</td> --}}
                                            <td><input type="number" name="layanan[]"
                                                    value="{{ $item->stok_bidang_layanan }}">
                                            </td>
                                            <td><input type="number" name="keuangan[]"
                                                    value="{{ $item->stok_bidang_keuangan }}"></td>
                                            <td><input type="number" name="umum[]" value="{{ $item->stok_bidang_umum }}">
                                            </td>
                                            <td>{{ $item->Satuan->nama }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="mt-5 btn btn-success" id="setuju" data-bs-toggle="modal"
                                data-bs-target="#approveModal">Input Stok</button>
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
                        <button type="submit" class="btn btn-success">Approve</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Approve Modal -->
    </form>
@endsection
