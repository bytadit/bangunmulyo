@extends('layouts.main')
@section('title') @lang('Buku Tamu - Surat Masuk') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.tiny.cloud/1/3gzdxowqghug11auhjfqlb0gfnc9joj28yv4bc1h3w61ecag/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Buku Tamu @endslot
        @slot('title') Surat Masuk @endslot
    @endcomponent
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di UPT TIK!</h4>
                                <p class="text-muted mb-0">Berikut adalah data surat masuk ke UPT TIK UNS!</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-lg btn-label waves-effect waves-light mx-2 " data-bs-toggle="modal" data-bs-target="#createData">
                                <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                Tambah Data
                            </button>
                            <button type="button" class="btn btn-warning btn-lg btn-label waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createReport">
                                <i class="ri-file-upload-line label-icon align-middle fs-16 me-2"></i>
                                Ekspor Data
                            </button>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                @include('dashboard.surat.modals.create')
                @include('dashboard.surat.modals.report')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h1 class="mb-0">Data Surat Masuk</h1>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination" class="table dt-responsive table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Pengirim Surat</th>
                                        <th>Tujuan Surat</th>
                                        <th>Pinjam</th>
                                        <th>Kembali</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($surats as $surat)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($surat->tanggal)->format('D, d M Y') }}
                                            </td>
                                            <td>
                                                {{$surat->no_surat}}
                                            </td>
                                            <td>
                                                {{$surat->perihal}}
                                            </td>
                                            <td>
                                                {{$surat->pengirim_surat}}
                                            </td>
                                            <td>
                                                {{$surat->tujuan_surat}}
                                            </td>
                                            <td>
                                                {{$surat->peminjaman}}
                                            </td>
                                            <td>
                                                {{$surat->pengembalian}}
                                            </td>
                                            <td>
                                                {!! $surat->keterangan !!}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-info mr-1" data-bs-toggle="modal" data-bs-target="#showData{{$surat->id}}">
                                                        <i class="ri-eye-fill"></i> <span >@lang('Lihat')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editData{{$surat->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteData{{$surat->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.surat.modals.edit')
                                        @include('dashboard.surat.modals.delete')
                                        @include('dashboard.surat.modals.show')
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
