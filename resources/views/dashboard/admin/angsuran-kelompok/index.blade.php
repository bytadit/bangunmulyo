@extends('layouts.main')
@section('title') @lang('Data Riwayat Angsuran Kelompok {{ $kelompok_name }} - BUMDes Bangun Mulyo') @endsection
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
        @slot('li_3')
            Data Pinjaman Kelompok {{ $kelompok_name }}
        @endslot
        @slot('li_2_link')
            {{ route('angsuran-kelompok.daftar-peminjam') }}
        @endslot
        @slot('li_3_link')
            {{ route('angsuran-kelompok.daftar-pinjaman', ['kelompok' => $kelompok]) }}
        @endslot
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Progress Pinjaman Kelompok {{ $kelompok_name }} Periode ke - {{ $periode }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <div data-simplebar style="max-height: 405px;">
                                        <table class="table table-borderless align-middle">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Peminjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ \Carbon\Carbon::parse($pinjaman->first()->tgl_pinjaman)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Jatuh Tempo
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ \Carbon\Carbon::parse($pinjaman->first()->tgl_jatuh_tempo)) }}</h6>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tanggal Pelunasan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->first()->tgl_pelunasan == null ? 'Belum Diatur' : \Carbon\Carbon::parse($pinjaman->first()->tgl_pelunasan)->isoFormat('D MMMM Y') }}</h6>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="fw-medium">
                                                        Jangka Waktu
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->first()->jangka_waktu }} Bulan</h6>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td class="fw-medium">
                                                        Jumlah Pinjaman
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($pinjaman->first()->jumlah_pinjaman)</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Angsuran
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($pinjaman->first()->jumlah_angsuran)</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Pokok
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($pinjaman->first()->jumlah_pokok)</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Nilai Iuran
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($pinjaman->first()->jumlah_iuran)</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Total Pokok Dibayarkan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($angsurans->sum('pokok'))</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Total Iuran Dibayarkan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($angsurans->sum('iuran'))</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Tunggakan Pokok
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($pinjaman->first()->jumlah_pinjaman - $angsurans->sum('pokok'))</h6>
                                                    </td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="fw-medium">
                                                        Tunggakan Iuran
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">
                                                            @if($pinjaman->first()->tgl_pelunasan != null)
                                                                @currency(($pinjaman->first()->jumlah_iuran * $bulan_iuran) - $angsurans->sum('iuran'))
                                                            @else
                                                                @currency(($pinjaman->first()->jumlah_iuran * $pinjaman->first()->jangka_waktu) - $angsurans->sum('iuran'))
                                                            @endif
                                                        </h6>
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td class="fw-medium">
                                                        Total Simpanan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">@currency($angsurans->sum('simpanan'))</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-medium">
                                                        Keterangan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <h6 class="fs-15 mb-1">{{ $pinjaman->first()->keterangan == 1 ? 'Lunas' : 'Belum Lunas' }}</h6>
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
                @include('dashboard.admin.angsuran-kelompok.modals.create')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h3 class="card-title mb-0 flex-grow-1">Riwayat Angsuran Kelompok {{ $kelompok_name }} Periode ke - {{ $periode }}</h3>
                                <div class="flex-shrink-0">
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#createDataAngsuranKelompok">
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
                                        <th>Angsuran Ke-</th>
                                        <th>Tanggal Angsuran</th>
                                        {{-- <th>Tanggal Jatuh Tempo</th> --}}
                                        <th>Iuran</th>
                                        <th>Pokok</th>
                                        <th>Angsuran</th>
                                        <th>Simpanan</th>
                                        <th>Keterangan</th>
                                        <th>Dokumen</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($angsurans as $angsuran)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $angsuran->angsuran_ke }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($angsuran->tgl_angsuran)->isoFormat('D MMMM Y') }}
                                            </td>
                                            {{-- <td>
                                                {{ \Carbon\Carbon::parse($angsuran->tgl_jatuh_tempo)->isoFormat('D MMMM Y') }}
                                            </td> --}}
                                            <td>
                                                @currency($angsuran->iuran)
                                            </td>
                                            <td>
                                                @currency($angsuran->pokok)
                                            </td>
                                            <td>
                                                @currency($angsuran->angsuran_dibayarkan)
                                            </td>
                                            <td>
                                                @currency($angsuran->simpanan)
                                            </td>
                                            <td>
                                                {{ $angsuran->keterangan }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <form action="{{ route('cetak.kuitansi-angsuran-kelompok') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_peminjam" value="{{ $angsuran->pinjaman->peminjam->id }}">
                                                        <input type="hidden" name="id_pinjaman" value="{{ $angsuran->pinjaman->id }}">
                                                        <input type="hidden" name="id_angsuran" value="{{ $angsuran->id }}">
                                                        <button type="submit" class="btn btn-sm btn-primary mr-1"><i class="ri-printer-line"></i> <span >@lang('Cetak Kuitansi')</span></button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-warning mx-1"  data-bs-toggle="modal" data-bs-target="#editDataAngsuranKelompok{{$angsuran->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteDataAngsuranKelompok{{$angsuran->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.admin.angsuran-kelompok.modals.edit')
                                        @include('dashboard.admin.angsuran-kelompok.modals.delete')
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
