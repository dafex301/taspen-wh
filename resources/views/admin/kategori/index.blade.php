@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong>Manajemen Kategori</strong>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                                    Buat Kategori
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane active preview" role="tabpanel" id="preview-719">
                                    <table class="table table-hover" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Foreach laporan --}}
                                            @foreach ($kategori as $k)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">{{ $k->name }}</th>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#updateModal"
                                                            data-id="{{ $k->id }}" data-name="{{ $k->name }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-id="{{ $k->id }}" data-name="{{ $k->name }}">
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
    <form method="POST" action="/admin/kategori" id="createForm">
        @csrf
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Buat Kategori</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="create-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="create-name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Kategori</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End of Create Modal --}}

    {{-- Update Modal --}}
    <form method="POST" action="/admin/kategori" id="updateForm">
        @method('PUT')
        @csrf
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Kategori</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="update-name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="update-name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah Kategori</button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Kategori</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex align-items-center flex-column justify-content-center">
                    <img src="{{ url('assets/img/warning.webp') }}" alt="Warning" srcset=""
                        class="img-fluid w-25">
                    <p class="text-center mt-3">Apakah anda yakin ingin menghapus kategori ini?</p>
                    <h4 class="text-center" id="deleteIdentity">Kategori</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Kategori</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Delete Modal --}}

    {{-- Update Script --}}
    <script>
        $('#updateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var name = button.data('name')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            $('#update-name').val(name)

            // Set the action of the form to /admin/kategori/{id}
            $('#updateForm').attr('action', '/admin/kategori/' + id)
        })
    </script>
    {{-- End of Update Script --}}

    {{-- Delete Script --}}
    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var name = button.data('name')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // Set the identity of the account to be deleted
            $('#deleteIdentity').text(name)

            // Set the action of the form to /admin/kategori/{id}
            $('#deleteForm').attr('action', '/admin/kategori/' + id)
        })
    </script>
    {{-- End of Delete Script --}}
@endsection
