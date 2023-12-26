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
    <title>Taspen Warehouse System</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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



</head>

<body class="">
    <div class="sidebar sidebar-fixed noprint" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <h5 class="">Taspen Warehouse System</h5>
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
                @if (auth()->user()->Role->nama === 'Admin')
                    <li class="nav-title">Menu Admin</li>
                    <li class="nav-item w-100"><a class="nav-link" href="/admin/akun">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                            Manajemen Akun</a></li>
                    <li class="nav-item w-100"><a class="nav-link" href="/admin/kategori">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M12 6.75a5.25 5.25 0 016.775-5.025.75.75 0 01.313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 011.248.313 5.25 5.25 0 01-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 112.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0112 6.75zM4.117 19.125a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75h-.008a.75.75 0 01-.75-.75v-.008z"
                                    clip-rule="evenodd" />
                            </svg>
                            Manajemen Kategori</a></li>
                @else
                    @if (auth()->user()->Role->nama === 'Sector Head')
                        <li class="nav-title">Menu Sector Head</li>
                        <li class="nav-item w-100"><a class="nav-link" href="/bidang/permintaan/verifikasi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path fill-rule="evenodd"
                                        d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />

                                </svg>
                                Verifikasi Permintaan</a></li>
                        <li class="nav-item w-100"><a class="nav-link" href="/bidang/permintaan/history">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path
                                        d="M5.625 3.75a2.625 2.625 0 100 5.25h12.75a2.625 2.625 0 000-5.25H5.625zM3.75 11.25a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75zM3 15.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75zM3.75 18.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75z" />

                                </svg>
                                History Permintaan</a></li>
                        <li class="nav-item w-100"><a class="nav-link" href="/bidang/pengadaan/verifikasi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path fill-rule="evenodd"
                                        d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />

                                </svg>
                                Verifikasi Pengadaan</a></li>
                        <li class="nav-item w-100"><a class="nav-link" href="/bidang/pengadaan/history">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path
                                        d="M5.625 3.75a2.625 2.625 0 100 5.25h12.75a2.625 2.625 0 000-5.25H5.625zM3.75 11.25a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75zM3 15.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75zM3.75 18.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75z" />

                                </svg>
                                History Pengadaan</a>
                        </li>
                        {{-- @endif --}}
                    @elseif (auth()->user()->Role->nama == 'Manager')
                        <li class="nav-title">Menu Manager</li>
                        <li class="nav-item w-100">
                            <a class="nav-link" href="/umum/stok">
                                <svg style="width: 20px; margin: 0 5px 0 5px" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                Input Stok
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a class="nav-link" href="/umum/permintaan/approval">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path fill-rule="evenodd"
                                        d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.016a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                Approval Permintaan
                            </a>
                        </li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/permintaan/histories">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path
                                        d="M5.625 3.75a2.625 2.625 0 100 5.25h12.75a2.625 2.625 0 000-5.25H5.625zM3.75 11.25a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75zM3 15.75a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75zM3.75 18.75a.75.75 0 000 1.5h16.5a.75.75 0 000-1.5H3.75z" />

                                </svg>
                                History Permintaan</a></li>

                        <li class="nav-item w-100"><a class="nav-link" href="/umum/pengadaan/approval">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 20px; margin: 0 5px 0 5px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />

                                </svg>
                                Approval Pengadaan</a>
                        </li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/pengadaan/histories">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14"
                                    style="width: 13px; margin: 0 10px 0 8px">
                                    <path
                                        d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM9 6v2H2V6h7Zm2 0h7v2h-7V6Zm-9 4h7v2H2v-2Zm9 2v-2h7v2h-7Z" />
                                </svg>
                                History Pengadaan</a>
                        </li>
                        <li class="nav-title">Menu Manajemen Data</li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/items">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 10"
                                    style="width: 13px; margin: 0 10px 0 8px">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M6 1h10M6 5h10M6 9h10M1.49 1h.01m-.01 4h.01m-.01 4h.01" />
                                </svg>
                                Manajemen Item</a>
                        </li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/permintaan">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    style="width: 13px; margin: 0 10px 0 8px" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 18 20">
                                    <path
                                        d="M5 9V4.13a2.96 2.96 0 0 0-1.293.749L.879 7.707A2.96 2.96 0 0 0 .13 9H5Zm11.066-9H9.829a2.98 2.98 0 0 0-2.122.879L7 1.584A.987.987 0 0 0 6.766 2h4.3A3.972 3.972 0 0 1 15 6v10h1.066A1.97 1.97 0 0 0 18 14V2a1.97 1.97 0 0 0-1.934-2Z" />
                                    <path
                                        d="M11.066 4H7v5a2 2 0 0 1-2 2H0v7a1.969 1.969 0 0 0 1.933 2h9.133A1.97 1.97 0 0 0 13 18V6a1.97 1.97 0 0 0-1.934-2Z" />
                                </svg>
                                Manajemen Permintaan</a>
                        </li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/pengadaan">
                                <svg style="width: 13px; margin: 0 10px 0 8px"
                                    class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                    <path
                                        d="M14.067 0H7v5a2 2 0 0 1-2 2H0v4h7.414l-1.06-1.061a1 1 0 1 1 1.414-1.414l2.768 2.768a1 1 0 0 1 0 1.414l-2.768 2.768a1 1 0 0 1-1.414-1.414L7.414 13H0v5a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.933-2Z" />
                                </svg>
                                Manajemen Pengadaan</a>
                        </li>
                        <li class="nav-item w-100"><a class="nav-link" href="/umum/users">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18"
                                    style="width: 13px; margin: 0 10px 0 8px">
                                    <path
                                        d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                                </svg>
                                Manajemen User</a>
                        </li>
                    @endif

                    @if (Auth::user()->Bidang->nama === 'HC & GA' && Auth::user()->Role->nama === 'Manager')
                    @endif

                    <li class="nav-title">Menu Permintaan</li>
                    <li class="nav-item w-100"><a class="nav-link" href="/permintaan/create">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                <path
                                    d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                            </svg>
                            Pengajuan Permintaan</a></li>
                    <li class="nav-item w-100"><a class="nav-link" href="/permintaan/history">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path fill-rule="evenodd"
                                    d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                            </svg>

                            History Permintaan</a>
                    </li>

                    <li class="nav-title">Menu Pengadaan</li>
                    <li class="nav-item w-100"><a class="nav-link" href="/pengadaan/create">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875z" />
                                <path
                                    d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 001.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 001.897 1.384C6.809 12.164 9.315 12.75 12 12.75z" />
                                <path
                                    d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 15.914 9.315 16.5 12 16.5z" />
                                <path
                                    d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 001.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 001.897 1.384C6.809 19.664 9.315 20.25 12 20.25z" />

                            </svg>

                            Usulan Pengadaan</a></li>
                    <li class="nav-item w-100"><a class="nav-link" href="/pengadaan/history">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                style="width: 20px; margin: 0 5px 0 5px">
                                <path
                                    d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                                <path fill-rule="evenodd"
                                    d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z"
                                    clip-rule="evenodd" />

                            </svg>



                            History Pengadaan</a></li>
                @endif


            @endauth

            @guest
                <li class="nav-title">Menu Tamu</li>
                <li class="nav-item w-100"><a class="nav-link" href="/login">

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
        <header class="header header-sticky mb-4 bg-light noprint">
            <div class="container-fluid">
                <button class="header-toggler px-md-3 me-md-3 bg-success text-white" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="{{ url('vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
                    </svg>
                </button>
                <a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                    </svg>
                </a>
                @auth
                    <ul class="header-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">

                                @if (Auth::user()->Bidang->nama === 'Branch Manager')
                                    Welcome, {{ Auth::user()->nama }} -
                                    {{ Auth::user()->Bidang->nama }}
                                @elseif (Auth::user()->Bidang->nama === 'HC & GA' && Auth::user()->Role->nama === 'Manager')
                                    Welcome, {{ Auth::user()->nama }} -
                                    {{ Auth::user()->Bidang->nama }} - Sector Head
                                @else
                                    Welcome, {{ Auth::user()->nama }} -
                                    {{ Auth::user()->Bidang->nama }} - {{ Auth::user()->Role->nama }}
                                @endif

                            </a>
                        </li>
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
        <footer class="footer noprint" style="padding: 10px 32px">
            {{-- <img src={{ url('assets/img/logo.png') }} alt="T-SAFE" width="70"> --}}
            <div><b>Warehouse System - PT. Taspen (Persero)</b></div>
            <div></div>
            <img src={{ url('assets/img/taspen.png') }} alt="PT. Taspen" width="80">
        </footer>
        {{-- End of Footer --}}

    </div>

    {{-- Scripts --}}
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

        $(document).ready(function() {
            var table = $('#myTableClear').DataTable({
                lengthChange: false,
            });

            table.buttons().container()
                .appendTo($('div.column.is-half', table.table().container()).eq(0));
        });
    </script>

    <script>
        $('#updateUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var nama = button.data('nama')
            var nik = button.data('nik')
            var username = button.data('username')
            var role = button.data('role')
            var bidang = button.data('bidang')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            $('#update-nama').val(nama)
            $('#update-username').val(username)
            $('#update-role').val(role)
            $('#update-nik').val(nik)
            $('#update-bidang').val(bidang)

            // Set the action of the form to /admin/akun/{id}
            $('#updateForm').attr('action', '/umum/users/' + id)
        })

        $('#deleteUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var nama = button.data('nama')
            var nik = button.data('nik')
            var username = button.data('username')
            var role = button.data('role')
            var bidang = button.data('bidang')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // Set the identity of the account to be deleted
            $('#deleteIdentity').text(nik + ' - ' + nama)

            // Set the action of the form to /admin/akun/{id}
            $('#deleteForm').attr('action', '/umum/users/' + id)
        })
    </script>


    <script>
        $('#updateItemModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var nama = button.data('nama')
            var kode = button.data('kode')
            var harga = button.data('harga')
            var kategori = button.data('kategori')
            var satuan = button.data('satuan')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            $('#update-nama').val(nama)
            $('#update-harga').val(harga)
            $('#update-kategori').val(kategori)
            $('#update-kode').val(kode)
            $('#update-satuan').val(satuan)

            // Set the action of the form to /admin/akun/{id}
            $('#updateForm').attr('action', '/umum/items/' + id)
        })

        $('#deleteItemModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id')
            var nama = button.data('nama')
            var kode = button.data('kode')
            var harga = button.data('harga')
            var kategori = button.data('kategori')
            var satuan = button.data('satuan')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // Set the identity of the account to be deleted
            $('#deleteIdentity').text(kode + ' - ' + nama)

            // Set the action of the form to /admin/akun/{id}
            $('#deleteForm').attr('action', '/umum/items/' + id)
        })
    </script>

</body>

</html>
