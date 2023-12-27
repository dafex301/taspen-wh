@extends('layouts.main')

@section('container')
    <form action="/umum/stok" method="POST">
        @csrf
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
                        <div class="card p-4 mb-4">
                            <div class="d-flex justify-content-between align-items-center w-100">

                                <h3 class="text-center">Input Stok</h3>
                                <div>
                                    <button type="BUTTON" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#importModal">
                                        Import CSV
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="downloadCSV()">Download
                                        CSV</button>

                                </div>
                            </div>
                            <table class="table table-hover" id="itemTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Stok Layanan</th>
                                        <th scope="col">Stok Keuangan</th>
                                        <th scope="col">Stok Umum</th>
                                        <th scope="col">Stok Cash & Pensiun</th>
                                        <th scope="col">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <input name="id[]" hidden type="text" value="{{ $item->id }}">
                                        <tr>
                                            <td scope="row" hidden>{{ $item->id }}</td>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <th>{{ $item->nama }}</th>
                                            <td>{{ $item->Kategori->nama }}</td>
                                            <td><input type="number" name="layanan[]"
                                                    value="{{ $item->stok_bidang_layanan }}">
                                            </td>
                                            <td><input type="number" name="keuangan[]"
                                                    value="{{ $item->stok_bidang_keuangan }}"></td>
                                            <td><input type="number" name="umum[]" value="{{ $item->stok_bidang_umum }}">
                                            <td><input type="number" name="pensiun[]"
                                                    value="{{ $item->stok_bidang_pensiun }}">
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
                        <h1 class="modal-title fs-5" id="approveModalLabel">Tambah Stok</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                        <img src="{{ url('assets/img/accept.jpeg') }}" alt="Approve" srcset=""
                            class="img-fluid w-25 mb-2">
                        <h5 class="text-center">Apakah anda yakin untuk <i>tambah stok</i> ini?</h5>
                        <div id="approve-text"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Ya</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Approve Modal -->
    </form>

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <form method="POST" action="/umum/stok/import" id="importForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Import Data</h5>
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
                        <button type="submit" class="btn btn-primary">Import Data</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End of Import Modal --}}

    <script>
        function downloadCSV() {
            // Get the table
            var table = document.getElementById('itemTable');

            // Create a CSV string
            var csv = [];

            // Add header row
            var headerRow = ['ID', 'Nama', 'Stok Layanan', 'Stok Keuangan', 'Stok Umum', 'Stok Cash & Pensiun'];
            csv.push(headerRow.join(','));

            // Add data rows
            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                var rowData = [];

                // Get Nama (assuming it's the first cell in each row)
                var id = row.cells[1].innerText.trim();
                rowData.push(id);
                var nama = row.cells[2].innerText.trim();
                rowData.push('"' + nama + '"');

                for (var j = 4; j < row.cells.length; j++) {
                    var inputField = row.cells[j].querySelector('input');
                    var cellValue = inputField ? inputField.value.trim() : '';
                    rowData.push(cellValue);
                }
                csv.push(rowData.join(','));
            }

            // Combine CSV rows into a string
            var csvString = csv.join('\n');

            // Create a Blob and initiate the download
            var blob = new Blob([csvString], {
                type: 'text/csv'
            });
            var a = document.createElement('a');
            a.href = window.URL.createObjectURL(blob);
            a.download = 'items_and_stocks.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
@endsection
