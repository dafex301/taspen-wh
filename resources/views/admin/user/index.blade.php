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
                                <strong>Manajemen Akun</strong>
                                <div>

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                                        Import Akun
                                    </button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                        Buat Akun
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane active preview" role="tabpanel" id="preview-719">
                                    <table class="table table-hover" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">NIK</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Bidang</th>
                                                <th scope="col">Level</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Foreach laporan --}}
                                            @foreach ($users as $u)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">{{ $u->nik }}</th>
                                                    <th scope="row">{{ $u->nama }}</th>
                                                    <td scope="">{{ $u->username }}</td>
                                                    <td scope="">{{ $u->Bidang->nama }}</td>
                                                    <td scope="">{{ $u->role }}</td>
                                                    <td>
                                                        {{-- <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#updateModal"
                                                            data-id="{{ $u->id }}" data-nama="{{ $u->nama }}"
                                                            data-nik="{{ $u->nik }}"
                                                            data-username="{{ $u->username }}"
                                                            data-bidang="{{ $u->bidang }}"
                                                            data-role="{{ $u->role }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </button> --}}
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#updateModal"
                                                            data-id="{{ $u->id }}" data-nama="{{ $u->nama }}"
                                                            data-username="{{ $u->username }}"
                                                            data-bidang="{{ $u->bidang }}"
                                                            data-role="{{ $u->role }}"
                                                            data-nik="{{ $u->nik }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </button>
                                                        @if ($u->id !== Auth::user()->id)
                                                            <button type="button" class="btn btn-outline-danger"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-id="{{ $u->id }}"
                                                                data-nama="{{ $u->nama }}"
                                                                data-nik="{{ $u->nik }}"
                                                                data-username="{{ $u->username }}"
                                                                data-bidang="{{ $u->bidang }}"
                                                                data-role="{{ $u->role }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        @endif
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
    <form method="POST" action="/umum/users" id="createForm">
        @csrf
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Akun</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="create-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="create-nik" class="col-form-label">NIK</label>
                            <input type="nik" class="form-control" id="create-nik" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label for="create-username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="create-username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="create-bidang" class="col-form-label">Bidang</label>
                            <select name="bidang" id="create-bidang" class="form-control" required>
                                @foreach ($bidang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create-role" class="col-form-label">Level</label>
                            <select name="role" id="create-role" class="form-control" required>
                                @foreach ($role as $r)
                                    <option value="{{ $r->id }}">{{ $r->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="create-password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="create-password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Akun</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End of Create Modal --}}

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <form method="POST" action="/umum/users/import" id="importForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Import Akun</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" class="col-form-label">Nama</label>
                            <input type="file" accept=".csv" class="form-control" id="file" name="file"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Akun</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End of Import Modal --}}

    {{-- Update Modal --}}
    <form method="POST" action="/umum/users" id="updateForm">
        @method('PUT')
        @csrf
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Akun</h5>
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
                            <label for="update-nik" class="col-form-label">NIK</label>
                            <input type="nik" class="form-control" id="update-nik" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="update-username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="update-username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="update-role" class="col-form-label">Level</label>
                            <select name="role" id="update-role" class="form-control">
                                @foreach ($role as $r)
                                    <option value="{{ $r->id }}">{{ $r->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="update-bidang" class="col-form-label">Bidang</label>
                            <select name="bidang" id="update-bidang" class="form-control">
                                @foreach ($bidang as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Akun</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End of Update Modal --}}

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Akun</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex align-items-center flex-column justify-content-center">
                    <img src="{{ url('assets/img/warning.webp') }}" alt="Warning" srcset=""
                        class="img-fluid w-25">
                    <p class="text-center mt-3">Apakah anda yakin ingin menghapus akun ini?</p>
                    <h4 class="text-center" id="deleteIdentity">Nama - Email</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/umum/users" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Delete Modal --}}
@endsection
