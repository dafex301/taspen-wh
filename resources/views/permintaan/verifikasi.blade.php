@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Approval Permintaan Bidang</strong></div>

                        <div class="card-body">

                            <div class="tab-content rounded-bottom">
                                <div class="tab-pane active preview" role="tabpanel" id="preview-719">
                                    <table class="table table-hover" id="myTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kegiatan</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Pemohon</th>
                                                @if (Route::is('permintaan.umum.verifikasi'))
                                                    <th scope="col">Bidang</th>
                                                @endif
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permintaan as $p)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <th scope="row">{{ $p->kegiatan }}</th>
                                                    <td>{{ $p->created_at->format('d M Y') }}</td>
                                                    <td>{{ $p->Pemohon->nama }}</td>
                                                    @if (Route::is('permintaan.umum.verifikasi'))
                                                        <th scope="col">{{ $p->Bidang->nama }}</th>
                                                    @endif
                                                    <td>
                                                        @if (auth()->user()->Role->nama === 'Manajer Bidang')
                                                            <a href="/bidang/permintaan/verifikasi/{{ $p->id }}"
                                                                class="btn btn-outline-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                                </svg>
                                                            </a>
                                                        @else
                                                            <a href="/umum/permintaan/verifikasi/{{ $p->id }}"
                                                                class="btn btn-outline-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" style="height: 20px">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                                </svg>
                                                            </a>
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
@endsection
