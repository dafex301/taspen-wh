@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong>Manajemen Permintaan</strong>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                                    Import Data
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane active preview table-responsive" role="tabpanel" id="preview-719">
                                    <table class="table table-hover" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kegiatan</th>
                                                <th scope="col">Item</th>
                                                <th scope="col">Tanggal Permintaan</th>
                                                <th scope="col">Pemohon</th>
                                                <th scope="col">Bidang</th>
                                                <th scope="col">Approval Lv 2</th>
                                                <th scope="col">Approval Lv 3</th>
                                                <th scope="col">Tanggal Pengadaan</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengadaan as $p)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">
                                                        <div>{{ $p->kegiatan }}</div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            @foreach ($p->items as $item)
                                                                <p>
                                                                    {{ $item->nama }}
                                                                    <span>
                                                                        ({{ $item->pivot->jumlah }})
                                                                    </span>
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $p->created_at->format('d M Y') }}
                                                    </td>
                                                    @if (!request()->routeIs('permintaan.history'))
                                                        <td>{{ $p->Pemohon->nama }}</td>
                                                        <td>{{ $p->Bidang->nama }}</td>
                                                        <td>{{ $p->Manager_bidang->nama ?? '-' }}</td>
                                                        <td>{{ $p->Manager_umum->nama ?? '-' }}</td>
                                                        <td>{{ $p->waktu_manager_umum ? $p->waktu_manager_umum->format('d M Y') : '-' }}
                                                        </td>
                                                    @endif
                                                    @if ($p->status_manager_umum === 0)
                                                        <td>
                                                            <span class="badge badge-sm bg-danger">
                                                                Ditolak Manager Umum
                                                            </span>
                                                        </td>
                                                    @elseif ($p->status_manager_bidang === 0)
                                                        <td>
                                                            <span class="badge badge-sm bg-danger">
                                                                Ditolak Manager Bidang
                                                            </span>
                                                        </td>
                                                    @elseif ($p->status_manager_bidang === null)
                                                        <td>
                                                            <span class="badge badge-sm bg-primary">
                                                                Diproses Manager Bidang
                                                            </span>
                                                        </td>
                                                    @elseif ($p->status_manager_umum === null)
                                                        <td>
                                                            <span class="badge badge-sm bg-primary">
                                                                Diproses Manager Umum
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-sm bg-success">
                                                                Selesai
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        @if ($p->status_manager_bidang === 0 && $p->pemohon === auth()->user()->id)
                                                            <a href="/permintaan/revisi/{{ $p->id }}"
                                                                class="btn btn-outline-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                                </svg>
                                                            </a>
                                                        @elseif ($p->status_manager_umum === 0 && $p->manager_bidang === auth()->user()->id)
                                                            <a href="/bidang/permintaan/revisi/{{ $p->id }}"
                                                                class="btn btn-outline-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                                </svg>
                                                            </a>
                                                        @endif
                                                        <a href="/permintaan/detail/{{ $p->id }}"
                                                            class="btn btn-outline-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                style="height: 20px">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
        aria-hidden="true">
        <form method="POST" action="/umum/pengadaan/import" id="importForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Import Pengadaan</h5>
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
                        <button type="submit" class="btn btn-primary">Buat Permintaan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- End of Import Modal --}}
@endsection
