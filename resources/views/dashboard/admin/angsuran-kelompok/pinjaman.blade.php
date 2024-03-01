@extends('layouts.main')
@section('title') @lang('Data Pinjaman Kelompok {{ $kelompok_name }} - BUMDes Bangun Mulyo') @endsection
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
            {{ route('angsuran-kelompok.daftar-peminjam') }}
        @endslot
        @slot('title')
            Data Pinjaman Kelompok {{ $kelompok_name }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di SI BUMDes Bangun Mulyo!</h4>
                                <p class="text-muted mb-0">Berikut adalah data pinjaman kelompok {{ $kelompok_name }} di BUMDes Bangun Mulyo!</p>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h1 class="mb-0">Pinjaman Kelompok {{ $kelompok_name }}</h1>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>Tanggal Pinjaman</th>
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
                                                {{ \Carbon\Carbon::parse($pinjaman->tgl_jatuh_tempo)->isoFormat('D MMMM Y') }}
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
                                                <div class="d-flex align-items-center fw-medium">
                                                    <form action="{{ route('cetak.kuitansi-lunas-kelompok') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_peminjam" value="{{ $pinjaman->peminjam->id }}">
                                                        <input type="hidden" name="id_pinjaman" value="{{ $pinjaman->id }}">
                                                        <button type="submit" class="btn btn-sm mr-1 {{ $pinjaman->keterangan == 0 ? 'disabled btn-danger' : 'btn-success'}}"><i class="ri-file-download-line"></i> <span >@lang('Kuitansi Lunas')</span></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <a class="btn btn-sm btn-primary mr-1" href="{{ route('riwayat-angsuran-kelompok.index', ['kelompok' => $pinjaman->id, 'pinjaman_kelompok' => $pinjaman->id]) }}">
                                                        <i class="ri-history-fill"></i> <span >@lang('Riwayat Angsuran')</span>
                                                    </a>
                                                    <button class="btn btn-sm btn-info mx-1"  data-bs-toggle="modal" data-bs-target="#showInfoPinjaman{{$pinjaman->id}}">
                                                        <i class="ri-eye-line"></i> <span >@lang('Informasi Pinjaman')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.angsuran-kelompok.modals.info-pinjaman')
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
