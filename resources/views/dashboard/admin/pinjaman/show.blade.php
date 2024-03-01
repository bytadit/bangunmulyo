@extends('layouts.main')
@section('title') @lang('Detail Pinjaman Kelompok - BUMDes Bangun Mulyo') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            SI BUMDes Bangun Mulyo
        @endslot
        @slot('li_2')
            Data Peminjam Kelompok
        @endslot
        @slot('li_2_link')
            {{ route('peminjam-kelompok.index') }}
        @endslot
        @slot('li_3')
            Detail Kelompok {{ $kelompok_name }}
        @endslot
        @slot('li_3_link')
            {{ route('detail-kelompok.index', ['kelompok' => $kelompok]) }}
        @endslot
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                {{-- <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column float-end">
                            <button type="button" class="btn btn-primary btn-lg btn-label waves-effect waves-light mx-2" data-bs-toggle="modal" data-bs-target="#createDataPeminjamKelompok">
                                <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                Tambah Anggota
                            </button>
                        </div>
                    </div>
                    <!--end col-->
                </div> --}}
                <!--end row-->
                @include('dashboard.admin.angsuran-kelompok.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        @include('dashboard.admin.pinjaman-anggota.modals.create')
                        @if($pinjaman_anggota->count() > 0)
                            @include('dashboard.admin.pinjaman-anggota.modals.edit')
                        @endif
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Detail Pinjaman Anggota {{ $anggota_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        @if($pinjaman_anggota->count() == 0)
                                            <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#createDataPinjamanAnggota">
                                                <i class="ri-pencil-line"></i>
                                                Atur Data
                                            </button>
                                        @elseif($pinjaman_anggota->count() > 0)
                                            <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#editDataPinjamanAnggota">
                                                <i class="ri-pencil-line"></i>
                                                Ubah Data
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <div data-simplebar style="max-height: 405px;">
                                        <table class="table table-borderless align-middle">
                                            <tbody>

                                                <tr>
                                                    <td class="fw-medium">
                                                        Jumlah Peminjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @if($pinjaman_anggota->first()->jumlah_pinjaman == null)
                                                                Belum Diatur
                                                            @else
                                                                @currency($pinjaman_anggota->first()->jumlah_pinjaman)
                                                            @endif
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keterangan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            {{ $pinjaman_anggota->first()->keterangan == null ? 'Belum Diatur' :  ($pinjaman_anggota->first()->keterangan == 1 ? 'Lunas' : 'Belum Lunas') }}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Peminjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman_anggota->first()->tgl_pinjaman == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman_anggota->first()->tgl_pinjaman)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Pencairan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman_anggota->first()->tgl_pencairan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman_anggota->first()->tgl_pencairan)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Pelunasan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman_anggota->first()->tgl_pelunasan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman_anggota->first()->tgl_pelunasan)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
    <div class="row">
        <div class="col">
            <div class="h-100">
                <!--end row-->
                @if($pinjaman_anggota->count() > 0)
                    @include('dashboard.admin.angsuran-kelompok.modals.create')
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Riwayat Angsuran Anggota {{ $anggota_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="{{ $pinjaman_anggota->count() == 0 ? 'disabled' : '' }} btn btn-success btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#createDataAngsuranAnggota">
                                            <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                            Tambah Riwayat Angsuran
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal Angsuran</th>
                                        <th>Iuran</th>
                                        <th>Pokok Dibayarkan</th>
                                        <th>Pokok Tunggakan</th>
                                        <th>Pokok Sisa</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($angsurans as $angsuran)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$angsuran->tgl_angsuran}}
                                            </td>
                                            <td>
                                                {{$angsuran->iuran}}
                                            </td>
                                            <td>
                                                {{$angsuran->pokok_dibayar}}
                                            </td>
                                            <td>
                                                {{$angsuran->pokok_tunggakan}}
                                            </td>
                                            <td>
                                                {{$angsuran->pokok_sisa}}
                                            </td>
                                            <td>
                                                {{$angsuran->keterangan}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editDataAngsuranAnggota{{$angsuran->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteDataAngsuranAnggota{{$angsuran->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @if($pinjaman_anggota->count() > 0)
                                            @include('dashboard.admin.angsuran-kelompok.modals.edit')
                                            @include('dashboard.admin.angsuran-kelompok.modals.delete')
                                        @endif
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
