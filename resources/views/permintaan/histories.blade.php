@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center" style="">
                    <div class="card-body">
                        <h5 class="card-title">History Permintaan</h5>
                        <p class="card-text">
                            {{ $permintaanCount['total'] ?? 0 }} Riwayat
                        </p>
                        <a class="btn btn-success" href="/umum/permintaan/history">Lihat Semua Permintaan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-3">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/pelayanan.png') }}"
                        style="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Services & Membership</h5>
                        <p class="card-text">
                            {{ $permintaanCount[1] ?? 0 }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/history/layanan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/keuangan.png') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Finance Administration</h5>
                        <p class="card-text">
                            {{ $permintaanCount[2] ?? 0 }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/history/keuangan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/sdm.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">HC & GA</h5>
                        <p class="card-text">
                            {{ $permintaanCount[3] ?? 0 }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/history/sdm">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/pensiun.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Cash & Pension Verif</h5>
                        <p class="card-text">
                            {{ $permintaanCount[4] ?? 0 }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/history/pensiun">Lihat</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
