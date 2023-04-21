@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center" style="">
                    <div class="card-body">
                        <h5 class="card-title">History Pengadaan</h5>
                        <p class="card-text">
                            {{ $realisasiPengadaan }} Riwayat
                        </p>
                        <a class="btn btn-success" href="/umum/pengadaan/history/approved">Lihat Pengadaan</a>
                        <div class="mt-2">
                            <a class="btn btn-light" href="/umum/pengadaan/history">Lihat Semua Pengadaan</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/pelayanan.png') }}"
                        style="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Layanan dan Kepesertaan</h5>
                        <p class="card-text">
                            {{ $pengadaanCount[0] }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/history/layanan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/keuangan.png') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Keuangan</h5>
                        <p class="card-text">
                            {{ $pengadaanCount[1] }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/history/keuangan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/sdm.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Umum dan SDM</h5>
                        <p class="card-text">
                            {{ $pengadaanCount[2] }} Riwayat
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/history/sdm">Lihat</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
