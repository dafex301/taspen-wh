@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong>Manajemen Item</strong>
                                <div>

                                    <a class="btn btn-warning" href="/umum/stok">
                                        Lihat Stok
                                    </a>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                                        Import Item
                                    </button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                        Buat Item
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane active preview" satuan="tabpanel" id="preview-719">
                                    <table class="table table-hover" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Foreach laporan --}}
                                            @foreach ($item as $i)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">{{ $i->kode }}</th>
                                                    <th scope="row">{{ $i->nama }}</th>
                                                    <td scope="">{{ $i->harga }}</td>
                                                    <td scope="">{{ $i->Kategori->nama }}</td>
                                                    <td scope="">{{ $i->Satuan->nama }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#updateItemModal"
                                                            data-id="{{ $i->id }}" data-nama="{{ $i->nama }}"
                                                            data-kode="{{ $i->kode }}"
                                                            data-harga="{{ $i->harga }}"
                                                            data-kategori="{{ $i->kategori }}"
                                                            data-satuan="{{ $i->satuan }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-bs-toggle="modal" data-bs-target="#deleteItemModal"
                                                            data-id="{{ $i->id }}" data-nama="{{ $i->nama }}"
                                                            data-kode="{{ $i->kode }}"
                                                            data-kode="{{ $i->kode }}"
                                                            data-harga="{{ $i->harga }}"
                                                            data-kategori="{{ $i->kategori }}"
                                                            data-satuan="{{ $i->satuan }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create Modal --}}
    <form method="POST" action="/umum/items" id="createForm">
        @csrf
        <div class="modal fade" id="createModal" tabindex="-1" satuan="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" satuan="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Item</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="create-name" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="create-kode" class="col-form-label">Kode</label>
                            <input type="text" class="form-control" id="create-kode" name="kode" required>
                        </div>
                        <div class="form-group">
                            <label for="create-harga" class="col-form-label">Harga</label>
                            <input type="number" class="form-control" id="create-harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="create-satuan" class="col-form-label">Satuan</label>
                            <select name="satuan" id="create-satuan" class="form-control" required>
                                @foreach ($satuan as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create-kategori" class="col-form-label">Kategori</label>
                            <select name="kategori" id="create-kategori" class="form-control" required>
                                @foreach ($kategori as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Item</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End of Create Modal --}}

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" satuan="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <form method="POST" action="/umum/items/import" id="importForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" satuan="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Import Item</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" class="col-form-label">File CSV</label>
                            <input type="file" accept=".csv" class="form-control" id="file" name="file"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Item</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End of Import Modal --}}

    {{-- Update Modal --}}
    <form method="POST" action="/umum/items" id="updateForm">
        @method('PUT')
        @csrf
        <div class="modal fade" id="updateItemModal" tabindex="-1" satuan="dialog"
            aria-labelledby="updateItemModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" satuan="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateItemModalLabel">Update Item</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="update-nama" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="update-nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="update-kode" class="col-form-label">Kode</label>
                            <input type="kode" class="form-control" id="update-kode" name="kode">
                        </div>
                        <div class="form-group">
                            <label for="update-harga" class="col-form-label">Harga</label>
                            <input type="number" class="form-control" id="update-harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="update-kategori" class="col-form-label">Kategori</label>
                            <select name="kategori" id="update-kategori" class="form-control">
                                @foreach ($kategori as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="update-satuan" class="col-form-label">Satuan</label>
                            <select name="satuan" id="update-satuan" class="form-control">
                                @foreach ($satuan as $r)
                                    <option value="{{ $r->id }}">{{ $r->id }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Item</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End of Update Modal --}}

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteItemModal" tabindex="-1" satuan="dialog" aria-labelledby="deleteItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" satuan="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex align-items-center flex-column justify-content-center">
                    <img src="{{ url('assets/img/warning.webp') }}" alt="Warning" srcset=""
                        class="img-fluid w-25">
                    <p class="text-center mt-3">Apakah anda yakin ingin menghapus Item ini?</p>
                    <h4 class="text-center" id="deleteIdentity">Nama - Email</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/umum/items" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Delete Modal --}}
@endsection
