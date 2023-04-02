@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/pelayanan.png') }}"
                        style="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Layanan dan Kepesertaan</h5>
                        <p class="card-text">
                            4 Usulan
                        </p>
                        <a class="btn btn-primary" href="#">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/keuangan.png') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Layanan dan Kepesertaan</h5>
                        <p class="card-text">
                            1 Usulan
                        </p>
                        <a class="btn btn-primary" href="#">Lihat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card" style=""><img class="card-img-top" src="{{ url('assets/img/sdm.jpg') }}"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">Bidang Layanan dan Kepesertaan</h5>
                        <p class="card-text">
                            9 Usulan
                        </p>
                        <a class="btn btn-primary" href="#">Lihat</a>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
