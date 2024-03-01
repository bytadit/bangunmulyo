@extends('layouts.main')
@section('title') @lang('Buku Tamu - Data Tamu') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Buku Tamu @endslot
        @slot('title') Data Tamu @endslot
    @endcomponent
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di UPT TIK!</h4>
                                <p class="text-muted mb-0">Berikut adalah data tamu yang pernah berkunjung ke UPT TIK UNS!</p>
                            </div>
{{--                            <button class="btn btn-lg btn-soft-success float-end">--}}
{{--                                <i class="ri-user-add-line"></i> <span >@lang('Tambah Tamu')</span>--}}
{{--                            </button><!-- end card header -->--}}
                            <button type="button" class="btn btn-primary btn-lg btn-label waves-effect waves-light mx-2 " data-bs-toggle="modal" data-bs-target="#createData">
                                <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                Tambah Data
                            </button>
                            <!-- <button type="button" class="btn btn-warning btn-lg btn-label waves-effect waves-light">
                                <i class="ri-file-upload-line label-icon align-middle fs-16 me-2"></i>
                                Ekspor Data
                            </button> -->
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                @include('dashboard.guests.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h1 class="mb-0">Data Tamu</h1>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Identitas</th>
                                        <th>Nama</th>
                                        <th>Gender</th>
                                        <th>Kategori Tamu</th>
                                        <th>Nomor Telepon/WA</th>
                                        <th>Jumlah Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($guests as $guest)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$guest->identity_number}}
                                            </td>
                                            <td>
                                                {{$guest->name}}
                                            </td>
                                            <td>
                                                {{$guest->gender == 1 ? 'Pria' : "Wanita"}}
                                            </td>
                                            <td>
                                                @if($guest->guest_category == 1)
                                                    Mahasiswa
                                                @elseif($guest->guest_category == 2)
                                                    Dosen
                                                @elseif($guest->guest_category == 3)
                                                    Staff
                                                @elseif($guest->guest_category == 4)
                                                    Lainnya
                                                @endif
                                            </td>
                                            <td>
                                                {{substr_replace($guest->phone, 'XXXX', 5, 100)}}
                                            </td>
                                            <td>
                                                {{$guest_books->where('guest_id', $guest->id)->count()}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-info mr-1" data-bs-toggle="modal" data-bs-target="#showData{{$guest->id}}" onclick="renderTable({{$guest->id}})">
                                                        <i class="ri-eye-fill"></i> <span >@lang('Lihat')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editData{{$guest->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteData{{$guest->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.guests.modals.edit')
                                        @include('dashboard.guests.modals.delete')
                                        @include('dashboard.guests.modals.show')
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
    <script type="text/javascript">
        function renderTable(data_id){
            $.ajax({
                type : 'get',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                url : '{{URL::to('guest-activity')}}',
                data:{'guest_id':data_id},
                success:function(data){
                    $('.table-field').html(data);
                }
            });
            document.addEventListener('DOMContentLoaded', function () {
                new DataTable('.activity-table', {
                    "scrollY":        "210px",
                    "scrollCollapse": true,
                    "paging":         false
                });
            });
        }
    </script>
{{--    <script type="text/javascript">--}}
{{--        document.addEventListener('DOMContentLoaded', function () {--}}
{{--            let table = new DataTable('.activity-table', {--}}
{{--                "scrollY":        "210px",--}}
{{--                "scrollCollapse": true,--}}
{{--                "paging":         false--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
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
    <script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/sweetalerts.init.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
