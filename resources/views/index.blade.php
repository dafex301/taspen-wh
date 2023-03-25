@extends('layouts.main')

@section('container')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-primary">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="">{{ $laporanTotal }}</h1>
                                <div>Total Laporan</div>
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
                                <h1 class="">{{ $laporanDiproses }}</h1>
                                <div>Laporan Diproses</div>
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
                                <h1 class="">{{ $waktuPenyelesaian }} <span class="fs-5">jam</span></h1>
                                <div>Rata-rata penyelesaian</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="opacity-25 w-50 position-relative mb-3" style="scale: 1.3">
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
                                <h1 class="">{{ $laporanSelesai }}</h1>
                                <div>Selesai</div>
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
            <!-- /.row-->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Traffic</h4>
                            {{-- <div class="small text-medium-emphasis">January - July 2023</div> --}}
                            <div>Januari - Desember {{}}</div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                        <canvas class="chart" id="main-chart" height="300"></canvas>
                    </div>
                </div>

            </div>


        </div>
    </div>

    {{-- Chart --}}
    <script>
        /* global Chart, coreui */

        /**
         * --------------------------------------------------------------------------
         * CoreUI Boostrap Admin Template (v4.2.2): main.js
         * Licensed under MIT (https://coreui.io/license)
         * --------------------------------------------------------------------------
         */

        // Disable the on-canvas tooltip
        Chart.defaults.pointHitDetectionRadius = 1;
        Chart.defaults.plugins.tooltip.enabled = false;
        Chart.defaults.plugins.tooltip.mode = "index";
        Chart.defaults.plugins.tooltip.position = "nearest";
        Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
        Chart.defaults.defaultFontColor = "#646470";
        const random = (min, max) =>
            // eslint-disable-next-line no-mixed-operators
            Math.floor(Math.random() * (max - min + 1) + min);

        // // eslint-disable-next-line no-unused-vars
        // const cardChart1 = new Chart(document.getElementById("card-chart1"), {
        //     type: "line",
        //     data: {
        //         labels: [
        //             "January",
        //             "February",
        //             "March",
        //             "April",
        //             "May",
        //             "June",
        //             "July",
        //         ],
        //         datasets: [{
        //             label: "My First dataset",
        //             backgroundColor: "transparent",
        //             borderColor: "rgba(255,255,255,.55)",
        //             pointBackgroundColor: coreui.Utils.getStyle("--cui-primary"),
        //             data: [65, 59, 84, 84, 51, 55, 40],
        //         }, ],
        //     },
        //     options: {
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             },
        //         },
        //         maintainAspectRatio: false,
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false,
        //                     drawBorder: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //             y: {
        //                 min: 30,
        //                 max: 89,
        //                 display: false,
        //                 grid: {
        //                     display: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //         },
        //         elements: {
        //             line: {
        //                 borderWidth: 1,
        //                 tension: 0.4,
        //             },
        //             point: {
        //                 radius: 4,
        //                 hitRadius: 10,
        //                 hoverRadius: 4,
        //             },
        //         },
        //     },
        // });

        // // eslint-disable-next-line no-unused-vars
        // const cardChart2 = new Chart(document.getElementById("card-chart2"), {
        //     type: "line",
        //     data: {
        //         labels: [
        //             "January",
        //             "February",
        //             "March",
        //             "April",
        //             "May",
        //             "June",
        //             "July",
        //         ],
        //         datasets: [{
        //             label: "My First dataset",
        //             backgroundColor: "transparent",
        //             borderColor: "rgba(255,255,255,.55)",
        //             pointBackgroundColor: coreui.Utils.getStyle("--cui-info"),
        //             data: [1, 18, 9, 17, 34, 22, 11],
        //         }, ],
        //     },
        //     options: {
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             },
        //         },
        //         maintainAspectRatio: false,
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false,
        //                     drawBorder: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //             y: {
        //                 min: -9,
        //                 max: 39,
        //                 display: false,
        //                 grid: {
        //                     display: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //         },
        //         elements: {
        //             line: {
        //                 borderWidth: 1,
        //             },
        //             point: {
        //                 radius: 4,
        //                 hitRadius: 10,
        //                 hoverRadius: 4,
        //             },
        //         },
        //     },
        // });

        // // eslint-disable-next-line no-unused-vars
        // const cardChart3 = new Chart(document.getElementById("card-chart3"), {
        //     type: "line",
        //     data: {
        //         labels: [
        //             "January",
        //             "February",
        //             "March",
        //             "April",
        //             "May",
        //             "June",
        //             "July",
        //         ],
        //         datasets: [{
        //             label: "My First dataset",
        //             backgroundColor: "rgba(255,255,255,.2)",
        //             borderColor: "rgba(255,255,255,.55)",
        //             data: [78, 81, 80, 45, 34, 12, 40],
        //             fill: true,
        //         }, ],
        //     },
        //     options: {
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             },
        //         },
        //         maintainAspectRatio: false,
        //         scales: {
        //             x: {
        //                 display: false,
        //             },
        //             y: {
        //                 display: false,
        //             },
        //         },
        //         elements: {
        //             line: {
        //                 borderWidth: 2,
        //                 tension: 0.4,
        //             },
        //             point: {
        //                 radius: 0,
        //                 hitRadius: 10,
        //                 hoverRadius: 4,
        //             },
        //         },
        //     },
        // });

        // // eslint-disable-next-line no-unused-vars
        // const cardChart4 = new Chart(document.getElementById("card-chart4"), {
        //     type: "bar",
        //     data: {
        //         labels: [
        //             "January",
        //             "February",
        //             "March",
        //             "April",
        //             "May",
        //             "June",
        //             "July",
        //             "August",
        //             "September",
        //             "October",
        //             "November",
        //             "December",
        //             "January",
        //             "February",
        //             "March",
        //             "April",
        //         ],
        //         datasets: [{
        //             label: "My First dataset",
        //             backgroundColor: "rgba(255,255,255,.2)",
        //             borderColor: "rgba(255,255,255,.55)",
        //             data: [
        //                 78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98, 34, 84, 67,
        //                 82,
        //             ],
        //             barPercentage: 0.6,
        //         }, ],
        //     },
        //     options: {
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 display: false,
        //             },
        //         },
        //         scales: {
        //             x: {
        //                 grid: {
        //                     display: false,
        //                     drawTicks: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //             y: {
        //                 grid: {
        //                     display: false,
        //                     drawBorder: false,
        //                     drawTicks: false,
        //                 },
        //                 ticks: {
        //                     display: false,
        //                 },
        //             },
        //         },
        //     },
        // });

        // eslint-disable-next-line no-unused-vars
        let kategori = {!! json_encode($kategori) !!};
        let laporanPerKategori = {!! json_encode($laporanPerKategori) !!};
        laporanPerKategori = laporanPerKategori.map((item) => {
            return item.reverse();
        });

        console.log(kategori);
        console.log(laporanPerKategori);

        // Create a dataset for borderColor, borderWith, and backgroundColor
        const colorData = {
            borderColor: [
                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-info"),
                    10
                ),

                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-success"),
                    10
                ),

                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-danger"),
                    10
                ),

                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-warning"),
                    10
                ),

                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-primary"),
                    10
                ),

                coreui.Utils.hexToRgba(
                    coreui.Utils.getStyle("--cui-secondary"),
                    10
                ),
            ],

            backgroundColor: [coreui.Utils.getStyle("--cui-info"), coreui.Utils.getStyle("--cui-success"), coreui.Utils
                .getStyle("--cui-danger"), coreui.Utils.getStyle("--cui-warning"), coreui.Utils.getStyle(
                    "--cui-primary"), coreui.Utils.getStyle("--cui-secondary")
            ],
        };

        const mainChart = new Chart(document.getElementById("main-chart"), {
            type: "line",

            data: {
                labels: [
                    ...Array.from({
                        length: 12
                    }, (_, i) => {
                        const date = new Date();
                        date.setMonth(date.getMonth() - i);
                        return date.toLocaleString("default", {
                            month: "short",
                            year: "numeric"
                        });
                    }).reverse(),
                ],

                datasets: [
                    // {
                    //     label: {!! json_encode($kategori[0]->name) !!},
                    // backgroundColor: coreui.Utils.hexToRgba(
                    //         coreui.Utils.getStyle("--cui-info"),
                    //         10
                    //     ),
                    //     borderColor: coreui.Utils.getStyle("--cui-info"),
                    //     pointHoverBackgroundColor: "#fff",
                    //     borderWidth: 2,
                    //     data: [
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //     ],
                    //     fill: true,
                    // },
                    // {
                    //     label: "My Second dataset",
                    //     borderColor: coreui.Utils.getStyle("--cui-success"),
                    //     pointHoverBackgroundColor: "#fff",
                    //     borderWidth: 2,
                    //     data: [
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //         random(50, 200),
                    //     ],
                    // },
                    // {
                    //     label: "My Third dataset",
                    //     borderColor: coreui.Utils.getStyle("--cui-danger"),
                    //     pointHoverBackgroundColor: "#fff",
                    //     borderWidth: 1,
                    //     borderDash: [8, 1, 2],
                    //     data: [65, 65, 65, 65, 65, 65, 65],
                    // },



                    // Loop laporanPerKategori and generate datset
                    ...laporanPerKategori.map((item, index) => {
                        return {
                            label: kategori[index].name,
                            backgroundColor: colorData.backgroundColor[index],
                            borderColor: colorData.borderColor[index],
                            pointHoverBackgroundColor: "#fff",
                            borderWidth: 4,
                            data: item,
                        };
                    }),
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    x: {
                        grid: {
                            drawOnChartArea: false,
                        },
                    },
                    y: {
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            stepSize: Math.ceil(250 / 5),
                            max: 250,
                        },
                    },
                },
                elements: {
                    line: {
                        tension: 0.4,
                    },
                    point: {
                        radius: 0,
                        hitRadius: 10,
                        hoverRadius: 4,
                        hoverBorderWidth: 3,
                    },
                },
            },
        });
        //# sourceMappingURL=main.js.map
    </script>
@endsection
