@extends('layouts.main')
@section('title') @lang('Buku Tamu - Halaman Utama') @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/quill/quill.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Riwayat Tamu @endslot
        @slot('title') Beranda @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Selamat Datang di UPT TIK!</h4>
                                <p class="text-muted mb-0">Silakan mengisi buku tamu berikut yaa!</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-lg btn-label waves-effect waves-light mx-2" data-bs-toggle="modal" data-bs-target="#createData">
                                <i class="ri-user-add-line label-icon align-middle fs-16 me-2"></i>
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
{{--                Modals Area--}}
                @include('dashboard.guestbook.modals.create')
                @include('dashboard.guestbook.modals.report')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h1 class="mb-0">Riwayat Tamu UPT TIK</h1>
                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination" class="table dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal, Waktu</th>
                                        <!-- <th>Waktu</th> -->
                                        <th>Nama</th>
                                        <th>Unit</th>
                                        <th>No Telepon</th>
                                        <th>Kategori Keperluan</th>
                                        <th>Keperluan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($guest_books as $guest_book)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($guest_book->created_at)->format('D, d M Y') }}
                                                <br>
                                                {{ \Carbon\Carbon::parse($guest_book->created_at)->format('H:i:s') }}
                                            </td>
                                            <!-- <td>
                                            </td> -->
                                            <td>{{$guest_book->guest->name}}</td>
                                            <td>{{$guest_book->unit->display_name}}</td>
                                            <td>{{substr_replace($guest_book->guest->phone, 'XXXXXX', 5, 100)}}</td>
                                            <td>{{$guest_book->problemCategory->name}}</td>
                                            <td>
                                                {{--{!! $guest_book->description !!}--}}
                                                <p class=" d-inline-block text-truncate" style="max-width: 150px;">{{ $guest_book->description }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center fw-medium">
                                                    <button class="btn btn-sm btn-info mr-1"  data-bs-toggle="modal" data-bs-target="#showData{{$guest_book->id}}">
                                                        <i class="ri-eye-fill"></i> <span >@lang('Lihat')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#editData{{$guest_book->id}}">
                                                        <i class="ri-pencil-line"></i> <span >@lang('Ubah')</span>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#deleteData{{$guest_book->id}}">
                                                        <i class="ri-delete-bin-line"></i> <span >@lang('Hapus')</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('dashboard.guestbook.modals.edit')
                                        @include('dashboard.guestbook.modals.delete')
                                        @include('dashboard.guestbook.modals.show')
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
@endsection
