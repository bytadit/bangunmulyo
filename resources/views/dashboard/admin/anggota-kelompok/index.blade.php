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
        @slot('li_1')
            SI BUMDes Bangun Mulyo
        @endslot
        @slot('li_2')
            Data Peminjam Kelompok
        @endslot
        @slot('li_2_link')
            {{ route('peminjam-kelompok.index') }}
        @endslot
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                {{-- @include('dashboard.admin.anggota-kelompok.modals.create') --}}
                <div class="row">
                    <div class="col-lg-12">
                        @include('dashboard.admin.pinjaman.modals.create')
                        @include('dashboard.admin.anggota-kelompok.modals.edit-kelompok')
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Informasi Kelompok {{ $kelompok_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#editDataKelompok">
                                            <i class="ri-pencil-line"></i>
                                            Ubah Data
                                        </button>
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
                                                        Nama Kelompok
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $kelompoks->first()->nama }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nomor HandPhone
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $kelompoks->first()->noHP }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nama Dusun
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $kelompoks->first()->nama_dusun }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Alamat
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $kelompoks->first()->alamat }}</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--
                        @if($pinjaman->count() > 0)
                            @include('dashboard.admin.pinjaman.modals.edit')
                        @endif
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Detail Pinjaman Kelompok {{ $kelompok_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        @if($pinjaman->count() == 0)
                                            <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#createDataPinjaman">
                                                <i class="ri-pencil-line"></i>
                                                Atur Data
                                            </button>
                                        @elseif($pinjaman->count() > 0)
                                            <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#editDataPinjaman">
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
                                                        Tanggal Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->count() == 0 ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->first()->tgl_pinjaman)) }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Periode Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->count() == 0 ? 'Belum Diatur' : $pinjaman->first()->periode_pinjaman }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Jumlah Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @if($pinjaman->count() == 0)
                                                                Belum Diatur
                                                            @elseif($pinjaman->count() > 0)
                                                                @currency($pinjaman->first()->jumlah_pinjaman)
                                                            @endif
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keperluan Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->count() == 0 ? 'Belum Diatur' : $pinjaman->first()->keperluan }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keterangan Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->count() == 0 ? 'Belum Diatur' :  ($pinjaman->first()->keterangan == 1 ? 'Lunas' : 'Belum Lunas') }}</h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
                @include('dashboard.admin.anggota-kelompok.modals.create')
                {{-- @include('dashboard.admin.anggota-kelompok.modals.import') --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Daftar Anggota Kelompok {{ $kelompok_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <a href="{{ route('export-anggota', ['kelompok' => $kelompok]) }}" class="btn btn-success btn-sm shadow-none">
                                            <i class="ri-file-upload-line label-icon align-middle fs-16 me-2"></i>
                                            Export Data
                                        </a>
                                        {{-- <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#importDataAnggotaKelompok">
                                            <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                            Import Data
                                        </button> --}}
                                        <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#createDataAnggotaKelompok">
                                            <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                            Tambah Anggota
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination" class="table align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>NIK</th>
                                        <th>Nama Anggota</th>
                                        <th>Jabatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Usia</th>
                                        <th>No HP</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($anggotas as $anggota)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$anggota->nik}}
                                            </td>
                                            <td>
                                                {{$anggota->nama}}
                                            </td>
                                            <td>
                                                {{$anggota->jabatan->nama_jabatan}}
                                            </td>
                                            <td>
                                                {{$anggota->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan'}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($anggota->tgl_lahir)->diffInYears(\Carbon\Carbon::now())}} Tahun
                                            </td>
                                            <td>
                                                {{$anggota->noHP}}
                                            </td>
                                            <td>
                                                {{$anggota->pekerjaan}}
                                            </td>
                                            <td>
                                                {{$anggota->alamat}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    {{-- <a class="btn btn-sm btn-primary mr-1" href="{{ route('pinjaman-anggota.index', ['kelompok' => $kelompok, 'anggota' => $anggota->id]) }}">
                                                        <i class="ri-group-2-fill"></i> <span >@lang('Detail Pinjaman')</span>
                                                    </a> --}}
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editDataAnggotaKelompok{{$anggota->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteDataAnggotaKelompok{{$anggota->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.anggota-kelompok.modals.edit')
                                        @include('dashboard.admin.anggota-kelompok.modals.delete')
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
    <div class="row">
        <div class="col">
            <div class="h-100">
                <!--end row-->

                @include('dashboard.admin.pinjaman.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Riwayat Pinjaman Kelompok {{ $kelompok_name }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#createDataPinjaman">
                                            <i class="ri-menu-add-line label-icon align-middle fs-16 me-2"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>Tanggal Pinjaman</th>
                                        <th>Tanggal Pencairan</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Keperluan</th>
                                        <th>Keterangan</th>
                                        <th>Dokumen</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pinjamans as $pinjaman)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$pinjaman->periode_pinjaman}}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($pinjaman->tgl_pinjaman)->isoFormat('D MMMM Y') }}
                                            </td>
                                            <td>
                                                {{ $pinjaman->tgl_pencairan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->tgl_pencairan)->isoFormat('D MMMM Y') }}
                                            </td>
                                            <td>
                                                {{ $pinjaman->tgl_jatuh_tempo == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->tgl_jatuh_tempo)->isoFormat('D MMMM Y') }}
                                            </td>
                                            <td>
                                                @currency($pinjaman->jumlah_pinjaman)
                                            </td>
                                            <td>
                                                {{$pinjaman->keperluan}}
                                            </td>
                                            <td>
                                                <span class="badge border {{$pinjaman->keterangan == 1 ? 'border-success text-success' : 'border-danger text-danger'}}">{{$pinjaman->keterangan == 1 ? 'Lunas' : 'Belum Lunas'}}</span>
                                            </td>
                                            <td>
                                                {{-- <div class="d-flex align-items-center fw-medium">
                                                    <form action="{{ route('cetak.proposal') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_peminjam" value="{{ $pinjaman->peminjam->id }}">
                                                        <input type="hidden" name="id_pinjaman" value="{{ $pinjaman->id }}">
                                                        <button type="submit" class="btn btn-sm btn-info mr-1"><i class="ri-printer-fill"></i> <span >@lang('Cetak Proposal')</span></button>
                                                    </form>
                                                </div> --}}
                                                <div class="d-flex align-items-center fw-medium">
                                                    <form action="{{ route('cetak.ba-pencairan') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_peminjam" value="{{ $pinjaman->peminjam->id }}">
                                                        <input type="hidden" name="id_pinjaman" value="{{ $pinjaman->id }}">
                                                        <button type="submit" class="btn btn-sm btn-info mr-1 {{ $pinjaman->tgl_pencairan == null ? 'disabled' : '' }}"><i class="ri-printer-fill"></i> <span >@lang('Cetak BA Pencairan')</span></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <a class="btn btn-sm btn-primary mr-1" href="{{ route('pinjaman-kelompok.show', ['kelompok' => $kelompok, 'pinjaman_kelompok' => $pinjaman->id]) }}">
                                                        <i class="ri-information-line"></i> <span >@lang('Detail Pinjaman')</span>
                                                    </a>
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editDataPinjaman{{$pinjaman->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteDataPinjaman{{$pinjaman->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.pinjaman.modals.edit')
                                        @include('dashboard.admin.pinjaman.modals.delete')
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
