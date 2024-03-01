@extends('layouts.main')
@section('title') @lang('Detail Pinjaman Perorangan - BUMDes Bangun Mulyo') @endsection
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
            Data Peminjam Perorangan
        @endslot
        @slot('li_2_link')
            {{ route('peminjam-single.index') }}
        @endslot
        @slot('li_3')
            Detail Peminjam {{ $single_name }}
        @endslot
        @slot('li_3_link')
            {{ route('detail-single.index', ['single' => $single]) }}
        @endslot
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                {{-- @include('dashboard.admin.angsuran-kelompok.modals.create') --}}
                <div class="row">
                    <div class="col-lg-12">
                        {{-- @include('dashboard.admin.pinjaman-anggota.modals.create') --}}
                        @include('dashboard.admin.pinjaman-single.modals.edit-full')
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Detail Pinjaman {{ $single_name }} Periode Ke - {{ $periode }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none"  data-bs-toggle="modal" data-bs-target="#editFullDataPinjaman">
                                            <i class="ri-pencil-line"></i>
                                            Ubah Data
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <div data-simplebar style="max-height: 405px;">
                                        <table class="table align-left table-borderless table-hover">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keterangan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            {{  $pinjaman->first()->keterangan == 1 ? 'Lunas' : 'Belum Lunas' }}
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @currency($pinjaman->first()->jumlah_pinjaman)
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Angsuran
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @currency($pinjaman->first()->jumlah_angsuran)
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Pokok Yang Dibayarkan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @currency($pinjaman->first()->jumlah_pokok)
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Iuran/Jasa
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @currency($pinjaman->first()->jumlah_iuran)
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Jangka Waktu
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            {{ $pinjaman->first()->jangka_waktu }} Bulan
                                                        </h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Peminjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ \Carbon\Carbon::parse($pinjaman->first()->tgl_pinjaman)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Jatuh Tempo
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ \Carbon\Carbon::parse($pinjaman->first()->tgl_jatuh_tempo)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Pencairan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->first()->tgl_pencairan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->first()->tgl_pencairan)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Pelunasan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->first()->tgl_pelunasan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->first()->tgl_pelunasan)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keperluan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            {{ $pinjaman->first()->keperluan }}
                                                        </h6>
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
    {{-- <div class="row">
        <div class="col">
            <div class="h-100">
                <!--end row-->
                @include('dashboard.admin.pinjaman-anggota.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Rencana Angsuran Kelompok {{ $kelompok_name }} Periode Ke - {{ $periode }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="{{ $anggotas->whereNotIn('id', $pinjaman_anggotas->pluck('anggota_id'))->count() == 0 ? 'disabled btn-success' : 'btn-primary' }} btn btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#createDataPinjamanAnggota">
                                            <i class="{{ $anggotas->whereNotIn('id', $pinjaman_anggotas->pluck('anggota_id'))->count() == 0 ? 'ri-checkbox-line' : 'ri-menu-add-line' }} label-icon align-middle fs-16 me-2"></i>
                                            @if($anggotas->whereNotIn('id', $pinjaman_anggotas->pluck('anggota_id'))->count() == 0)
                                                Semua Anggota Sudah Memiliki Pinjaman
                                            @elseif($anggotas->whereNotIn('id', $pinjaman_anggotas->pluck('anggota_id'))->count() > 0)
                                                Tambah Pinjaman Anggota (Tersisa {{ $anggotas->whereNotIn('id', $pinjaman_anggotas->pluck('anggota_id'))->count() }} Orang)
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="scroll-horizontal" class="table nowrap align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Nilai Angsuran</th>
                                        <th>Pokok</th>
                                        <th>Iuran</th>
                                        <th>Jaminan</th>
                                        <th>Nilai Jaminan</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pinjaman_anggotas as $pinjaman_anggota)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$pinjaman_anggota->anggotaKelompok->nama}}
                                            </td>
                                            <td>
                                                @currency($pinjaman_anggota->jumlah_pinjaman)
                                            </td>
                                            <td>
                                                @currency($pinjaman_anggota->nilai_angsuran)
                                            </td>
                                            <td>
                                                @currency($pinjaman_anggota->pokok)
                                            </td>
                                            <td>
                                                @currency($pinjaman_anggota->iuran)
                                            </td>
                                            <td>
                                                {{$pinjaman_anggota->jaminan}}
                                            </td>
                                            <td>
                                                @currency($pinjaman_anggota->nilai_jaminan)
                                            </td>
                                            <td>
                                                {{$pinjaman_anggota->keterangan}}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editDataPinjamanAnggota{{$pinjaman_anggota->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteDataPinjamanAnggota{{$pinjaman_anggota->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.pinjaman-anggota.modals.edit')
                                        @include('dashboard.admin.pinjaman-anggota.modals.delete')
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
    </div> --}}

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
