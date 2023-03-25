@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header"><strong>Lapor Potensi Bahaya</strong></div>
                        <form action="{{ route('lapor.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="tab-content rounded-bottom">
                                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-719">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputTanggal">Hari dan Tanggal</label>
                                            <input class="form-control" id="inputTanggal" type="date" name="tanggal"
                                                placeholder="" value="{{ old('tanggal') }}">
                                            @error('tanggal')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="lokasi">Lokasi</label>
                                            <input class="form-control" id="lokasi" type="text" name="lokasi"
                                                placeholder="" value="{{ old('lokasi') }}">
                                            @error('lokasi')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="jenis">Jenis / Kategori Potensi Bahaya</label>
                                            <select class="form-select" aria-label="Jenis" id="jenis" name="kategori">
                                                @if (old('kategori') == null)
                                                    <option value="" disabled selected>Pilih Jenis / Kategori</option>
                                                @else
                                                    <option value="" disabled>Pilih Jenis / Kategori</option>
                                                @endif
                                                {{-- Foreach kategori --}}
                                                @foreach ($kategori as $item)
                                                    @if (old('kategori') == $item->id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                                @if (old('kategori') == '0')
                                                    <option selected value="0">Lain-lain</option>
                                                @else
                                                    <option value="0">Lain-lain</option>
                                                @endif
                                                {{-- End Foreach --}}
                                            </select>
                                            @error('kategori')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3" id="jenis-lain-container" style="display: none">
                                            <label class="form-label" for="jenis-lain">Jenis / Kategori</label>
                                            <input class="form-control" name="kategori_lain" id="jenis-lain" type="text"
                                                placeholder="" value="{{ old('kategori_lain') }}">
                                            @error('kategori_lain')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="deskripsi">Deskripsi</label>
                                            <input class="form-control" id="deskripsi" type="text" placeholder=""
                                                name="deskripsi" value="{{ old('deskripsi') }}">
                                            @error('deskripsi')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="image">Dokumentasi</label>
                                            <div class="img-container mb-2"></div>
                                            <input type="file" id="dokumentasi" class="form-control" accept="image/*"
                                                capture="camera" value="{{ old('image') }}" name="image">
                                            @error('image')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
