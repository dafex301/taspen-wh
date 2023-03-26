@extends('layouts.main')

@section('container')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h2>{{ $permintaan->kegiatan }}</h2>
                    <div>{{ $permintaan->created_at->format('d M Y') }}</div>
                    <div>{{ $permintaan->Bidang->nama }}</div>
                    <div>{{ $permintaan->Pemohon->nama }}</div>
                </div>

                @foreach ($kategori as $k)
                    <h5 class="text-center">{{ $k }}</h5>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width: 5%">No</th>
                                <th scope="col" style="width: 70%">Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $idx = 1; ?>
                            @foreach ($items as $i)
                                @if ($i->kategori === $k)
                                    <tr>
                                        <th scope="row">{{ $idx++ }}</th>
                                        <th scope="row">{{ $i->nama }}</th>
                                        <td scope="row">{{ $i->jumlah }}</td>
                                        <td scope="row">{{ $i->satuan }}</td>
                                        <td scope="row">{{ $i->kategori }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
@endsection
