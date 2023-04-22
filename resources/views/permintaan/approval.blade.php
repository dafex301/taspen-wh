@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card text-center" style="">
                    <div class="card-body">
                        <h5 class="card-title">Verifikasi Permintaan</h5>
                        <p class="card-text">
                            {{ $permintaanTotal }} Usulan
                        </p>
                        <a class="btn btn-success" href="/umum/permintaan/verifikasi">Lihat Semua</a>
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
                            {{ $permintaanLayanan }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/approval/layanan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/keuangan.png') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Keuangan</h5>
                        <p class="card-text">
                            {{ $permintaanKeuangan }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/approval/keuangan">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/sdm.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Umum dan SDM</h5>
                        <p class="card-text">
                            {{ $permintaanSDM }} Usulan
                        </p>
                        <a class="btn btn-primary" href="/umum/permintaan/approval/sdm">Lihat</a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
