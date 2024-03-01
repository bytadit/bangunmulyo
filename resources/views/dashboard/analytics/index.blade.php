@extends('layouts.main')
@section('title') @lang('Buku Tamu - Kategori Masalah') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css"/>
    <link rel="stylesheet" href="https://code.highcharts.com/dashboards/css/dashboards.css">
    <script src="https://code.highcharts.com/10/highcharts.js"></script>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Buku Tamu @endslot
        @slot('title') Analitik Data @endslot
    @endcomponent
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di UPT TIK!</h4>
                                <p class="text-muted mb-0">Berikut adalah analitik data tamu di UPT TIK UNS!</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-auto">
                                            <select class="form-control" id="group">
                                                <option value="Harian" selected>Harian</option>
                                                <option value="Mingguan">Mingguan</option>
                                                <option value="Bulanan">Bulanan</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $weekStartDate = $now->startOfWeek()->format('d-M-Y');
                                                $weekEndDate = $now->endOfWeek()->format('d-M-Y');
                                                //$startOfMonth = $now->copy()->startOfMonth()->format('d-M-Y');
                                                //$endOfMonth   = $now->copy()->endOfMonth()->format('d-M-Y');
                                            @endphp
                                                <input type="text" id="tanggal"
                                                       class="form-control border-0 dash-filter-picker shadow">
                                                <div
                                                    class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <!-- <div class="col-auto">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="ri-add-circle-line align-middle me-1"></i>
                                                Generate Report</button>
                                        </div> -->
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>

                <div class="row">
                    <div class="col-xl">
                        <div class="card">
                            <!-- <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                            </div> -->

                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="grafik" class="highcharts-dark"></div>
                                    <!-- <div id="customer_impression_charts"
                                         data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                         class="apex-charts" dir="ltr"></div> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>

                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h6 class="fs-14 mb-1">Analitik Keseluruhan</h6>
                                <!-- <p class="text-muted mb-0">Analitik Keseluruhan</p> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    
                    @foreach($keperluans as $keperluan)
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            {{ $keperluan->name }}</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                            <span class="counter-value" data-target="{{ $keperluan->guestBooks->count() }}">0</span>
                                        </h4>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    @endforeach

                </div> <!-- end row-->
                <!--end row-->
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

@endsection
@section('script')
    <!-- apexcharts -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <!-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> -->
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        var tanggal = "{{ $weekStartDate }} to {{ $weekEndDate }}";
        let chart;
        $(() => {
            createCharts(tanggal, $('#group').val())
        })

        flatpickr("#tanggal", {
            mode: "range",
            dateFormat: "d-M-Y",
            defaultDate: "{{ $weekStartDate }} to {{ $weekEndDate }}",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 1) {
                    tanggal = dateStr;
                    updateCharts(tanggal, $('#group').val());
                }
            }
        });

        $('#group').on('change', function() {
            updateCharts(tanggal, $(this).val())
        });

        function createCharts(date, group) {
            let url = "{{ url('/analytics', ['group_by']) }}";
            url = url.replace('group_by', group);
            $.ajax({
                url: url,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    'tanggal': date
                },
                dataType: 'json',
                success: (res) => {
                    initialChart(res.data);
                }
            })
        }

        function initialChart(data) {
            // const colors = [];
            // for (const key of data.data) {
            //     let color = Math.floor(Math.random()*16777215).toString(16);
            //     colors.push('#'+color);
            // }
            // console.log(data);
            // console.log(data.label);
            // console.log(data.data);

            // Data retrieved from:
            // - https://en.as.com/soccer/which-teams-have-won-the-premier-league-the-most-times-n/
            // - https://www.statista.com/statistics/383679/fa-cup-wins-by-team/
            // - https://www.uefa.com/uefachampionsleague/history/winners/
            chart = Highcharts.chart('grafik', {
                chart: {
                    type: 'column',
                    backgroundColor: '#212529'
                },
                title: {
                    text: `Grafik Analitik Data ${$('#group').val()} dari {{ $weekStartDate }} Sampai {{ $weekEndDate }}`,
                    align: 'left',
                    style: {
                        color: '#ced4da'
                    }
                },
                xAxis: {
                    categories: data.label
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Count trophies'
                    },
                    // stackLabels: {
                    //     enabled: true
                    // }
                },
                legend: {
                    align: 'center',
                    // x: 70,
                    verticalAlign: 'top',
                    // y: 30,
                    // width: '90%',
                    itemStyle: {
                        color: '#878a99',
                        fontWeight: undefined,
                    },
                    itemHoverStyle: {"color": "#ced4da"},
                    // floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#212529',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        // dataLabels: {
                        //     enabled: true
                        // }
                    }
                },
                series: data.data.map((item) => {
                    return {
                        name: item.name,
                        data: item.data,
                    }
                }),
            });


            // let options = {
            //     colors: colors,
            //     series: data.data.map((item) => {
            //         return {
            //             name: item.name,
            //             data: item.data,
            //         }
            //     }),
            //     chart: {
            //         type: 'bar',
            //         height: 400,
            //         stacked: true,
            //         toolbar: {
            //             show: true
            //         },
            //         zoom: {
            //             enabled: true
            //         }
            //     },
            //     responsive: [{
            //         breakpoint: 480,
            //         options: {
            //             legend: {
            //                 position: 'bottom',
            //                 offsetX: -10,
            //                 offsetY: 0
            //             }
            //         }
            //     }],
            //     plotOptions: {
            //         bar: {
            //             horizontal: false,
            //             borderRadius: 10,
            //             dataLabels: {
            //                 total: {
            //                     enabled: true,
            //                     style: {
            //                         fontSize: '13px',
            //                         fontWeight: 900
            //                     }
            //                 }
            //             }
            //         },
            //     },
            //     xaxis: {
            //         // type: 'datetime',
            //         categories: data.label,
            //     },
            //     legend: {
            //         position: 'bottom',
            //         offsetY: 10
            //     },
            //     fill: {
            //         opacity: 1
            //     }
            // };

            // chart = new ApexCharts(document.getElementById("grafik"), options);
            // chart.render();
        }

        function updateCharts(date, group) {
            let url = "{{ url('/analytics', ['group_by']) }}";
            url = url.replace('group_by', group);
            $.ajax({
                url: url,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    'tanggal': date
                },
                dataType: 'json',
                success: (res) => {
                    console.log(res.data);
                    console.log(res.data.label);
                    console.log(res.data.data);
                    chart.xAxis[0].setCategories(res.data.label);
                    chart.update({
                        title: {
                            text: `Grafik Analitik Data ${$('#group').val()} dari ${tanggal.replace('to', 'Sampai')}`,
                            align: 'left',
                            style: {
                                color: '#ced4da'
                            }
                        },
                        xAxis: {
                            categories: res.data.label
                        },
                        series: res.data.data.map((item) => {
                            return {
                                name: item.name,
                                data: item.data,
                            }
                        }),
                    });
                }
            })
        }
    </script>
@endsection
