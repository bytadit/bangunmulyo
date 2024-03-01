<div class="modal fade" id="showData{{$surat->id}}" tabindex="-1" aria-labelledby="modalShow{{$surat->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShow{{$surat->id}}">Detail Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Tanggal</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->tanggal}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Nomor Surat</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->no_surat}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Perihal</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->perihal}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Tujuan</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->tujuan_surat}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Asal/Pengirim</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->pengirim_surat}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Peminjaman</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->peminjaman}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Pengembalian</p>
                            </div>
                            <div class="col-lg-9">
                                <p class="m-0">: {{$surat->pengembalian}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="fw-bold m-0">Keterangan</p>
                            </div>
                            <div class="col-lg-9">
                                : {!! $surat->keterangan !!}
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>
    </div>
</div>
