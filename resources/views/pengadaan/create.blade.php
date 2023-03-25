@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Ajukan Pengadaan Barang</strong></div>
                        <form action="{{ route('pengadaan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-719">
                                        <div class="mb-3">
                                            <label class="form-label" for="bidang">Bidang</label>
                                            <input class="form-control" id="bidang" type="input" name="bidang"
                                                readonly placeholder="" value="{{ auth()->user()->Bidang->nama }}">
                                            @error('bidang')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="kegiatan">Kegiatan</label>
                                            <input class="form-control" id="kegiatan" type="text" name="kegiatan"
                                                placeholder="" value="{{ old('kegiatan') }}">
                                            @error('kegiatan')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="jenis">Pengadaan Barang</label>
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-select" aria-label="Jenis" id="jenis"
                                                        name="kategori[]">
                                                        @if (old('kategori') == null)
                                                            <option value="" disabled selected>Pilih Jenis /
                                                                Kategori</option>
                                                        @else
                                                            <option value="" disabled>Pilih Jenis / Kategori
                                                            </option>
                                                        @endif
                                                        {{-- Foreach kategori --}}
                                                        @foreach ($kategori as $item)
                                                            @if (old('kategori') == $item->id)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $item->id }}">{{ $item->nama }}
                                                                </option>
                                                            @endif
                                                        @endforeach

                                                        {{-- End Foreach --}}
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select class="form-select" name="item[]" id="">
                                                        <option value="">Pilih Barang</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="form-control" placeholder="Jumlah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <button class="btn btn-primary" type="submit">Submit Laporan</button>
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
        document.getElementById('inputTanggal').valueAsDate = new Date();
    </script>
@endsection
