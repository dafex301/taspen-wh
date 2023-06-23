@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card p-4 mb-4">
                        <table class="table table-hover" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    @auth
                                        <th scope="col">Jumlah Yang Dimiliki</th>
                                    @endauth
                                    <th scope="col">Jumlah Keseluruhan</th>
                                    <th scope="col">Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <th>{{ $item->nama }}</th>
                                        <td>{{ $item->Kategori->nama }}</td>
                                        @auth

                                            @if (auth()->user()->Bidang->nama === 'Bidang Keuangan')
                                                <td>{{ $item->stok_bidang_keuangan }}</td>
                                            @elseif(auth()->user()->Bidang->nama === 'Bidang Layanan dan Kepesertaan')
                                                <td>{{ $item->stok_bidang_layanan }}</td>
                                            @else
                                                <td>{{ $item->stok_bidang_umum }}</td>
                                            @endif
                                        @endauth

                                        <td>{{ $item->stok_bidang_keuangan + $item->stok_bidang_layanan + $item->stok_bidang_umum }}
                                        </td>
                                        <td>{{ $item->Satuan->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Ajukan Permintaan Barang</strong></div>
                        <form action="{{ route('permintaan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-719">
                                        <div class="mb-3">
                                            <label class="form-label" for="bidang">Bidang</label>
                                            <input class="form-control" type="input" readonly
                                                value="{{ auth()->user()->Bidang->nama }}">
                                            <input class="form-control" id="bidang" type="input" name="bidang" hidden
                                                value="{{ auth()->user()->Bidang->id }}">
                                            @error('bidang')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="kegiatan">Kegiatan</label>
                                            <input class="form-control" id="kegiatan" type="text" name="kegiatan"
                                                placeholder="" value="{{ old('kegiatan') }}" required>
                                            @error('kegiatan')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="add-container">
                                            <label class="form-label" for="jenis">Pengadaan Barang</label>
                                            <div class="row mb-3 add-barang">

                                                <div class="col">
                                                    <select class="form-select" name="item[]" id="barang1" required>
                                                        <option hidden value="">Pilih Barang</option>
                                                        @foreach ($kategori as $k)
                                                            <option value="" disabled>
                                                                -------------------------------------------{{ $k->nama }}-------------------------------------------
                                                                @foreach ($items as $i)
                                                                    @if ($i->kategori == $k->id)
                                                            <option value="{{ $i->id }}"
                                                                @if ($i->stok_bidang_layanan + $i->stok_bidang_keuangan + $i->stok_bidang_umum === 0) hidden @endif>
                                                                {{ $i->nama }} ({{ $i->Satuan->nama }})
                                                                | Stok Bidang:
                                                                @if (auth()->user()->bidang === 1)
                                                                    {{ $i->stok_bidang_layanan }}
                                                                @elseif (auth()->user()->bidang === 2)
                                                                    {{ $i->stok_bidang_keuangan }}
                                                                @else
                                                                    {{ $i->stok_bidang_umum }}
                                                                @endif
                                                                | Stok Keseluruhan:
                                                                {{ $i->stok_bidang_layanan + $i->stok_bidang_keuangan + $i->stok_bidang_umum }}
                                                            </option>
                                                        @endif
                                                        @endforeach
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="form-control" placeholder="Jumlah"
                                                        id="jumlah1" name="jumlah[]" required>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn btn-danger delete-btn"
                                                        style="display:none">
                                                        <svg class="delete-icon" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" style="width: 20px;">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 12h-15" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button class="btn btn-success" id="tambah-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" style="width: 20px;">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>

                                                <span>Tambah Barang
                                                </span> </button>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <button class="btn btn-primary" type="submit">Submit Permintaan</button>
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
    <script defer>
        // When tambah-btn clicked, duplicate elements with class add-barang inside add-container
        document.getElementById('tambah-btn').addEventListener('click', function(e) {
            e.preventDefault();
            let addContainer = document.getElementById('add-container');
            let addBarang = document.querySelector('.add-barang');
            let clone = addBarang.cloneNode(true);
            clone.querySelector('select').value = '';
            clone.querySelector('input').value = '';
            clone.querySelector('.delete-btn').style.display = 'block';
            let id = addContainer.childElementCount + 1;
            addContainer.appendChild(clone);
        });

        // When element with delete-btn class clicked, remove parent element
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-btn')) {
                e.preventDefault();
                e.target.parentElement.parentElement.remove();
            }
            if (e.target && e.target.classList.contains('delete-icon')) {
                e.preventDefault();
                e.target.parentElement.parentElement.parentElement.remove();
            }
        });
    </script>
@endsection
