<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>T-SAFE</title>
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ url('vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ url('css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ url('css/examples.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/dataTables.bootstrap5.min.css') }}">

    {{-- DataTables Stylesheet --}}
    <link rel="stylesheet" href="{{ url('css/datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatables/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatables/dataTables.bulma.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatables/buttons.bulma.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/datatables/font-awesome.min.css') }}">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link href="{{ url('vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">


    {{-- Script Defer --}}
    <!-- Bootstrap CDN -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery -->
    <script src="{{ url('js/jquery-3.6.3.slim.min.js') }}"></script>

    <!-- CoreUI and necessary plugins-->
    <script src="{{ url('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ url('vendors/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ url('vendors/chart.js/js/chart.min.js') }}"></script>
    <script src="{{ url('vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ url('vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    {{-- <script src="{{ url('js/main.js') }}"></script> --}}
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <h2>T-SAFE</h2>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item w-100"><a class="nav-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        style="width: 20px; margin: 0 5px 0 5px">
                        <path
                            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                        <path
                            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
                    </svg>

                    Beranda</a></li>
            <li class="nav-divider"></li>
            @auth
                <li class="nav-title">Menu Pegawai</li>
                @if (auth()->user()->Role->name === 'Admin')
                    <li class="nav-item"><a class="nav-link" href="/admin/akun">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                            Manajemen Akun</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/kategori">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z"
                                    clip-rule="evenodd" />
                            </svg>
                            Manajemen Kategori</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/lapor">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path
                                    d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                            Lapor Potensi Bahaya</a></li>
                    <li class="nav-item"><a class="nav-link" href="/laporan">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M9 1.5H5.625c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5zm6.61 10.936a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 14.47a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                            </svg>

                            Laporan Potensi Bahaya</a></li>
                    <li class="nav-item"><a class="nav-link" href="/history">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                            </svg>

                            History Laporan</a></li>
                @endif

                @if (auth()->user()->Role->name === 'PIC')
                    <li class="nav-title">Menu Admin</li>
                    <li class="nav-item"><a class="nav-link" href="/pic/laporan">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                            </svg>

                            Cek Laporan Masuk</a></li>

                    <li class="nav-item"><a class="nav-link" href="/pic/revisi">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                                <path
                                    d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                            </svg>
                            Revisi Laporan</a></li>
                @elseif (auth()->user()->Role->name === 'BM')
                    <li class="nav-title">Menu Branch Manager</li>
                    <li class="nav-item"><a class="nav-link" href="/bm/laporan">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                            </svg>

                            Approve Laporan</a></li>

                    <li class="nav-item"><a class="nav-link" href="/bm/revisi">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                                <path
                                    d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                            </svg>
                            Laporan Ditolak</a></li>
                @elseif (auth()->user()->Role->name === 'DPnP')
                    <li class="nav-title">Menu Div. PNP</li>
                    <li class="nav-item"><a class="nav-link" href="/dpnp/laporan">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                            </svg>

                            Approve Laporan</a></li>
                @endif
            @endauth

            @guest
                <li class="nav-title">Menu Tamu</li>
                <li class="nav-item"><a class="nav-link" href="/login">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            style="width: 20px; margin: 0 5px 0 5px">
                            <path fill-rule="evenodd"
                                d="M7.5 3.75A1.5 1.5 0 006 5.25v13.5a1.5 1.5 0 001.5 1.5h6a1.5 1.5 0 001.5-1.5V15a.75.75 0 011.5 0v3.75a3 3 0 01-3 3h-6a3 3 0 01-3-3V5.25a3 3 0 013-3h6a3 3 0 013 3V9A.75.75 0 0115 9V5.25a1.5 1.5 0 00-1.5-1.5h-6zm5.03 4.72a.75.75 0 010 1.06l-1.72 1.72h10.94a.75.75 0 010 1.5H10.81l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3a.75.75 0 010-1.06l3-3a.75.75 0 011.06 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Login</a></li>
            @endguest
        </ul>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">

        {{-- Header --}}
        <header class="header header-sticky mb-4 bg-light">
            <div class="container-fluid">
                <button class="header-toggler px-md-3 me-md-3 bg-success text-white" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ url('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                    </svg>
                </button>
                <a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="assets/brand/coreui.svg#full"></use>
                    </svg>
                </a>
                @auth
                    <ul class="header-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">
                                Welcome, {{ Auth::user()->name }} - {{ Auth::user()->Role->name }} -
                                {{ Auth::user()->Cabang->name }}</a></li>

                        <li class="nav-item"><a class="nav-link" href="#">
                                <svg class="icon icon-lg">
                                    <use xlink:href="{{ url('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                                </svg></a></li>
                    </ul>
                    <ul class="header-nav ms-3">
                        <a class="dropdown-item" href="{{ route('logout.perform') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ url('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                                </use>
                            </svg> Log out</a>
                    </ul>
                @endauth

                @guest

                    <ul class="header-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.show') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" style="height: 22px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>

                                Login</a></li>

                    </ul>
                @endguest



            </div>
        </header>
        {{-- End of Header --}}

        {{-- Body --}}
        @yield('container')
        {{-- End of Body --}}

        {{-- Footer --}}
        <footer class="footer">
            <div>Footer</div>
            <div class="ms-auto">Footer Kanan</div>
        </footer>
        {{-- End of Footer --}}

    </div>

    {{-- Scripts --}}




    <!-- DataTables -->
    <script src="{{ url('js/datatables.min.js') }}"></script>
    <script src="{{ url('js/datatables/dataTables.bulma.min.js') }}"></script>
    <script src="{{ url('js/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('js/datatables/buttons.bulma.min.js') }}"></script>
    <script src="{{ url('js/datatables/jszip.min.js') }}"></script>
    {{-- <script src="{{ url('js/datatables/pdfmake.min.js') }}"></script> --}}
    {{-- <script src="{{ url('js/datatables/vfs_fonts.js') }}"></script> --}}
    <script src="{{ url('js/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('js/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ url('js/datatables/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                lengthChange: false,
                buttons: [
                    'copy', 'csv', 'excel', 'print'
                ]
            });

            table.buttons().container()
                .appendTo($('div.column.is-half', table.table().container()).eq(0));
        });
    </script>

    <!-- Input Form -->
    <script>
        // Jenis Lain Input
        if ($('#jenis').val() == 0) {
            $('#jenis-lain-container').show();
        } else {
            $('#jenis-lain-container').hide();
        }

        $('#jenis').change(function() {
            console.log(($(this).val()));
            if ($(this).val() == 0) {
                $('#jenis-lain-container').show();
            } else {
                $('#jenis-lain-container').hide();
            }
        });
    </script>

    <!-- Modal Data -->
    <script>
        const imageModal = document.getElementById('imageModal')
        imageModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const image = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalBody = imageModal.querySelector('.modal-body')
            modalBody.innerHTML = `<img src="/storage/${image}" class="img-fluid" alt="Responsive image">`
        })
    </script>

    <!-- Upload Preview -->
    <script>
        // When upload image, show preview, keep the ratio to original
        $('#dokumentasi').change(function() {
            console.log('test2');
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var MAX_WIDTH = 300;
                    var MAX_HEIGHT = 300;
                    var width = img.width;
                    var height = img.height;
                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);
                    var dataurl = canvas.toDataURL('image/png');
                    $('.img-container').html('<img src="' + dataurl +
                        '" class="img-fluid" alt="Responsive image">');
                }
            }
            reader.readAsDataURL(file);
        });

        $('#completed-image').change(function() {
            console.log('test');
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var MAX_WIDTH = 300;
                    var MAX_HEIGHT = 300;
                    var width = img.width;
                    var height = img.height;
                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);
                    var dataurl = canvas.toDataURL('image/png');
                    $('.img-container-2').html('<img src="' + dataurl +
                        '" class="img-fluid" alt="Responsive image">');
                }
            }
            reader.readAsDataURL(file);
        });
    </script>

</body>

</html>
