<div class="modal fade" id="showData{{$guest->id}}" tabindex="-1" aria-labelledby="modalShow{{$guest->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow{{$guest->id}}">Detail Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">No Identitas</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">: {{$guest->identity_number}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">Nama</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">: {{$guest->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">Jenis Kelamin</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">: {{$guest->gender == 1 ? 'Pria' : "Wanita"}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">Kategori Tamu</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">:
                                        @if($guest->guest_category == 1)
                                            Mahasiswa
                                        @elseif($guest->guest_category == 2)
                                            Dosen
                                        @elseif($guest->guest_category == 3)
                                            Staff
                                        @elseif($guest->guest_category == 4)
                                            Lainnya
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">No Telepon</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">: {{$guest->phone}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <p class="fw-bold m-0">Riwayat Kunjungan</p>
                                </div>
                                <div class="col-lg-9">
                                    <p class="m-0">: {{$guest_books->where('guest_id', $guest->id)->count()}} Kali</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-field table-wrapper-scroll-y">
                            </div>
                        </div>
{{--                        @include('dashboard.guests.modals.table-guest')--}}
                    </div><!--end row-->
            </div>
        </div>
    </div>
</div>
