@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center" style="">
                    <div class="card-body">
                        <h5 class="card-title">Buat Pengadaan</h5>
                        <p class="card-text">
                            {{ $pengadaanTotal }} Usulan
                        </p>
                        <a class="btn btn-success" href="/umum/pengadaan/approval/create">Buat</a>
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
                            {{ $pengadaanLayanan }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/approval/layanan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/keuangan.png') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Keuangan</h5>
                        <p class="card-text">
                            {{ $pengadaanKeuangan }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/approval/keuangan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/sdm.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Umum dan SDM</h5>
                        <p class="card-text">
                            {{ $pengadaanSDM }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/pengadaan/approval/sdm">Lihat</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
