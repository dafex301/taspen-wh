@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @auth
                @if (auth()->user()->Role->nama === 'Staff')
                    <div class="row">
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-primary">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $totalPermintaan ?? 0 }}</h1>
                                        <div>Total Permintaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50 position-relative">
                                        <path fill-rule="evenodd"
                                            d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-warning">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $revisiPermintaan ?? 0 }}</h1>
                                        <div>Revisi Permintaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-success">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $totalPengadaan ?? 0 }}</h1>
                                        <div>Total Pengadaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-warning">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $revisiPengadaan ?? 0 }}</h1>
                                        <div>Revisi Pengadaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                @elseif (auth()->user()->Role->nama === 'Sector Head')
                    <div class="row">
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-primary">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $permintaanMasuk ?? 0 }}</h1>
                                        <div>Permintaan Masuk</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50 position-relative">
                                        <path fill-rule="evenodd"
                                            d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-warning">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $revisiPermintaan ?? 0 }}</h1>
                                        <div>Permintaan Revisi</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-info">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $pengadaanMasuk ?? 0 }}</h1>
                                        <div>Pengadaan Masuk</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                    </svg>


                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-warning">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $revisiPengadaan ?? 0 }}</h1>
                                        <div>Pengadaan Revisi</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                @else
                    <div class="row">
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-primary">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $permintaanMasuk ?? 0 }}</h1>
                                        <div>Permintaan Masuk</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50 position-relative">
                                        <path fill-rule="evenodd"
                                            d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-info">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $totalPermintaan ?? 0 }}</h1>
                                        <div>Total Permintaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path
                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                        <path
                                            d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                    </svg>


                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-warning">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $pengadaanMasuk ?? 0 }}</h1>
                                        <div>Pengadaan Masuk</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card mb-4 text-white bg-success">
                                <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1 class="">{{ $totalPengadaan ?? 0 }}</h1>
                                        <div>Total Pengadaan</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="opacity-25 w-50">
                                        <path fill-rule="evenodd"
                                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </div>

                            </div>
                        </div>
                        <!-- /.col-->
                    </div>
                @endif
            @endauth

            <!-- /.row-->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <table class="table table-hover" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    @auth
                                        @if (auth()->user()->bidang !== 5)
                                            <th scope="col">Jumlah Yang Dimiliki</th>
                                        @endif
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

                                            @if (auth()->user()->Bidang->nama === 'Finance Administration')
                                                <td>{{ $item->stok_bidang_keuangan }}</td>
                                            @elseif(auth()->user()->Bidang->nama === 'Services and Membership')
                                                <td>{{ $item->stok_bidang_layanan }}</td>
                                            @elseif(auth()->user()->Bidang->nama === 'HC & GA')
                                                <td>{{ $item->stok_bidang_umum }}</td>
                                            @elseif(auth()->user()->Bidang->nama === 'Cash & Pension Verif')
                                                <td>{{ $item->stok_bidang_pensiun }}</td>
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

            </div>


        </div>
    </div>
@endsection
