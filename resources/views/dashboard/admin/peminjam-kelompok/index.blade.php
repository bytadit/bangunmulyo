@extends('layouts.main')
@section('title') @lang('Data Peminjam Kelompok - BUMDes Bangun Mulyo') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') SI BUMDes Bangun Mulyo @endslot
        @slot('title') Data Peminjam Kelompok @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di SI BUMDes Bangun Mulyo!</h4>
                                <p class="text-muted mb-0">Berikut adalah peminjam kelompok di BUMDes Bangun Mulyo!</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-lg btn-label waves-effect waves-light mx-2" data-bs-toggle="modal" data-bs-target="#createDataPeminjamKelompok">
                                <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                @include('dashboard.admin.peminjam-kelompok.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h1 class="mb-0">Peminjam Kelompok</h1>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kelompok</th>
                                        <th>Alamat</th>
                                        <th>Nomor HP</th>
                                        <th>Nama Dusun</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($kelompoks as $kelompok)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$kelompok->nama}}
                                            </td>
                                            <td>
                                                {{$kelompok->alamat}}
                                            </td>
                                            <td>
                                                {{$kelompok->noHP}}
                                            </td>
                                            <td>
                                                {{$kelompok->nama_dusun}}
                                            </td>
                                            {{-- <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <a class="btn btn-sm btn-success mr-1" href="#">
                                                        <i class="ri-file-text-fill"></i> <span >@lang('Cetak Proposal')</span>
                                                    </a>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <a class="btn btn-sm btn-primary mr-1" href="{{ route('detail-kelompok.index', ['kelompok' => $kelompok->id]) }}">
                                                        <i class="ri-group-2-fill"></i> <span >@lang('Detail Kelompok')</span>
                                                    </a>
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editData{{$kelompok->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteData{{$kelompok->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.peminjam-kelompok.modals.edit')
                                        @include('dashboard.admin.peminjam-kelompok.modals.delete')
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

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
