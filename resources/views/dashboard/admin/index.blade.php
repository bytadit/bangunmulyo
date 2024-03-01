@extends('layouts.main')
@section('title') @lang('BUMDes Bangun Mulyo') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/quill/quill.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- flatpickr.js -->
    <script type='text/javascript' src='{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://raw.githubusercontent.com/flatpickr/flatpickr/master/src/l10n/id.ts"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Halaman Admin @endslot
        @slot('title') Beranda @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang Admin!</h4>
                                <p class="text-muted mb-0">Berikut adalah statistik aktivitas koperasi BUMDes "Bangun Mulyo"</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-medium text-muted mb-0">Total Peminjam Kelompok</h5>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $kelompoks->count() }}">0</span> Kelompok</h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary rounded-circle fs-2">
                                                <i data-feather="users"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-medium text-muted mb-0">Total Peminjam Perorangan</h5>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $singles->count() }}">0</span> Orang</h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info rounded-circle fs-2">
                                                <i data-feather="user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-medium text-muted mb-0">Total Pinjaman Lunas</h5>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $pinjamans->where('keterangan', 1)->count() }}">0</span> Pinjaman</h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success rounded-circle fs-2">
                                                <i data-feather="check-circle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5 class="fw-medium text-muted mb-0">Total Pinjaman Belum Lunas</h5>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                                data-target="{{ $pinjamans->where('keterangan', 0)->count() }}">0</span> Pinjaman</h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger rounded-circle fs-2">
                                                <i data-feather="slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row-->
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-xxl-12">
                                        <div class="">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Riwayat Pendapatan Jasa</h4>
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-soft-secondary shadow-none" data-timeframe="3m">
                                                            3M
                                                        </button>
                                                        <button type="button" class="btn btn-soft-secondary shadow-none" data-timeframe="6m">
                                                            6M
                                                        </button>
                                                        <button type="button" class="btn btn-soft-primary shadow-none" data-timeframe="1y">
                                                            1Y
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text" id="dateRangePicker" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="Y-m-d" data-deafult-date="01 Jan 2022 to 31 Jan 2022" style="width: 350px;"> <!-- Adjust the width as needed -->
                                                            <div class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                {{-- <div>
                                                    <button type="button" class="btn btn-soft-secondary shadow-none btn-sm" data-timeframe="3m">
                                                        3M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary shadow-none btn-sm" data-timeframe="6m">
                                                        6M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-primary shadow-none btn-sm" data-timeframe="1y">
                                                        1Y
                                                    </button>
                                                    <div class="col-sm-auto">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control border-0 dash-filter-picker shadow"
                                                                data-provider="flatpickr" data-range-date="true"
                                                                data-date-format="d M, Y"
                                                                data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                            <div class="input-group-text bg-primary border-primary text-white">
                                                                <i class="ri-calendar-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div><!-- end card header -->
                                            <div class="row g-0 text-center">
                                                <div class="col-6 col-sm-6">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">Rp. <span class="counter-value" data-target="{{ $angsurans }}">0</span></h5>
                                                        <p class="text-muted mb-0">Total Pendapatan Jasa</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6 col-sm-6">
                                                    <div class="p-3 border border-dashed border-start-0">
                                                        <h5 class="mb-1">Rp. <span class="counter-value" data-target="{{ $pinjaman }}">0</span></h5>
                                                        <p class="text-muted mb-0">Total Pinjaman Keluar</p>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <div id="line_chart_basic" data-colors='["--vz-info","--vz-success", "--vz-gray-300"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/quill/quill.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <!-- Marketplace init -->
    {{-- <script src="{{ URL::asset('assets/js/pages/dashboard-nft.init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <!-- toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{$error}}")
            @endforeach
        @endif
    </script>
    <script>
        function getChartColorsArray(chartId) {
            if (document.getElementById(chartId) !== null) {
                var colors = document.getElementById(chartId).getAttribute("data-colors");
                if (colors) {
                    colors = JSON.parse(colors);
                    return colors.map(function (value) {
                        var newValue = value.replace(" ", "");
                        if (newValue.indexOf(",") === -1) {
                            var color = getComputedStyle(document.documentElement).getPropertyValue(
                                newValue
                            );
                            if (color) return color;
                            else return newValue;
                        } else {
                            var val = value.split(",");
                            if (val.length == 2) {
                                var rgbaColor = getComputedStyle(
                                    document.documentElement
                                ).getPropertyValue(val[0]);
                                rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                                return rgbaColor;
                            } else {
                                return newValue;
                            }
                        }
                    });
                } else {
                    console.warn('data-colors atributes not found on', chartId);
                }
            }
        }

        var linechartBasicColors = getChartColorsArray("line_chart_basic");
        let months = [];
        let totalValues = [];

        // Function to fetch data based on timeframe
        function fetchData(timeframe) {
            // Make AJAX request to the backend to retrieve data
            fetch(`/api/data/iuran?timeframe=${timeframe}`)
                .then(response => response.json())
                .then(data => {
                    let dataArray = Object.values(data);
                    // Filter out non-numeric keys
                    let filteredDataArray = dataArray.filter(item => typeof item === 'object');
                    months = [];
                    totalValues = [];
                    const monthNames = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
                    console.log(filteredDataArray);
                    // Iterate through the response data
                    filteredDataArray.forEach(row => {
                        months.push(monthNames[row.month - 1]);
                        totalValues.push(row.total_iuran);
                    });
                    console.log(months);
                    // Update the chart data and categories
                    options.xaxis.categories = months;
                    options.series[0].data = totalValues;
                    options.series[0].name = data.name;
                    // Update the chart with the new data
                    chart.updateOptions(options);
                })
                .catch(error => console.error('Error fetching data:', error));
        }
        function fetchDataRange(startDate, endDate) {
            // Make AJAX request to the backend to retrieve data
            fetch(`/api/data/iuran-range?startDate=${startDate}&endDate=${endDate}`)
                .then(response => response.json())
                .then(data => {
                    let dataArray = Object.values(data);
                    // Filter out non-numeric keys
                    let filteredDataArray = dataArray.filter(item => typeof item === 'object');
                    let months = [];
                    let totalValues = [];
                    const monthNames = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];

                    // Iterate through the response data
                    filteredDataArray.forEach(row => {
                        months.push(monthNames[row.month - 1]);
                        totalValues.push(row.total_iuran);
                    });

                    // Update the chart data and categories
                    options.xaxis.categories = months;
                    options.series[0].data = totalValues;

                    // Update the chart with the new data
                    chart.updateOptions(options);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Initially fetch data for 3 months timeframe
        fetchData('1y');

        var options = {
            series: [
                {
                    name: '3 Bulan',
                    data: totalValues
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: linechartBasicColors,
            xaxis: {
                categories: months,
                labels: {
                    rotate: -90
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#line_chart_basic"), options);

        // Add an event listener to all buttons
        document.querySelectorAll('button[data-timeframe]').forEach(button => {
            button.addEventListener('click', function() {
                const timeframe = this.getAttribute('data-timeframe');
                console.log(timeframe);
                // Fetch data based on the selected timeframe
                fetchData(timeframe);
            });
        });
        flatpickr("#dateRangePicker", {
            mode: "range",
            // dateFormat: "Y-m-d",
            dateFormat: "j F Y \\s\\/\\d j F Y",
            locale: "id", // Indonesian locale
            onClose: function(selectedDates, dateStr, instance) {
                const startDate = selectedDates[0].toISOString().split('T')[0]; // Format start date
                const endDate = selectedDates[selectedDates.length - 1].toISOString().split('T')[0]; // Format end date
                console.log(startDate);
                fetchDataRange(startDate, endDate);
            }
        });

        // Render the chart
        chart.render();
    </script>
@endsection
