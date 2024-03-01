<div class="modal fade" id="showData{{$guest_book->id}}" tabindex="-1" aria-labelledby="modalShow{{$guest_book->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow{{$guest_book->id}}">Detail Riwayat Kunjungan</h5>
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
                                <p class="m-0">: {{$guest_book->guest->identity_number}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Nama</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$guest_book->guest->name}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Jenis Kelamin</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$guest_book->guest->gender == 1 ? 'Pria' : "Wanita"}}</p>
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
                                    @if($guest_book->guest->guest_category == 1)
                                        Mahasiswa
                                    @elseif($guest_book->guest->guest_category == 2)
                                        Dosen
                                    @elseif($guest_book->guest->guest_category == 3)
                                        Staff
                                    @elseif($guest_book->guest->guest_category == 4)
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
                                <p class="m-0">: {{$guest_book->guest->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Kunjungan ke-</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">:
                                    @foreach($guest_books->where('guest_id', $guest_book->guest_id)->sortBy('created_at') as $history)
                                        @if($history->id == $guest_book->id)
                                            {{ $loop->index + 1}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Kategori Keperluan</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">:
                                   {{$guest_book->problemCategory->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Detail Keperluan</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">:
                                    {{$guest_book->description}}
                                </p>
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
