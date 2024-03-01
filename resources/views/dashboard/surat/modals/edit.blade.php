<div class="modal fade" id="editData{{$surat->id}}" tabindex="-1" aria-labelledby="modalEdit{{$surat->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$surat->id}}">Ubah Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/surat/{{$surat->id}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="tanggal_edit_{{$surat->id}}" class="form-label">Tanggal</label>
                                <div class="input-group">
                                    <input type="text" id="tanggal_edit_{{$surat->id}}" class="form-control border-0 dash-filter-picker shadow" name='tanggal' required>
                                    <div class="input-group-text bg-primary border-primary text-white">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="no_surat_edit_{{$surat->id}}" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" name="no_surat" id="no_surat_edit_{{$surat->id}}" value="{{$surat->no_surat}}" placeholder="Masukkan nomor surat..." required>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="perihal_edit_{{$surat->id}}" class="form-label">Perihal</label>
                            <input type="text" class="form-control" name="perihal" id="perihal_edit_{{$surat->id}}" value="{{$surat->perihal}}" placeholder="Masukkan perihal surat..." required>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="pengirim_surat_edit_{{$surat->id}}" class="form-label">Asal/Pengirim</label>
                            <input type="text" class="form-control" name="pengirim_surat" id="pengirim_surat_edit_{{$surat->id}}" value="{{$surat->pengirim_surat}}" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="tujuan_edit_{{$surat->id}}" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" name="tujuan_surat" id="tujuan_edit_{{$surat->id}}" value="{{$surat->tujuan_surat}}" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="peminjaman_edit_{{$surat->id}}" class="form-label">Peminjaman</label>
                            <input type="text" class="form-control" name="peminjaman" id="peminjaman_edit_{{$surat->id}}" value="{{$surat->peminjaman}}" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="pengembalian_edit_{{$surat->id}}" class="form-label">Pengembalian</label>
                            <input type="text" class="form-control" name="pengembalian" id="pengembalian_edit_{{$surat->id}}" value="{{$surat->pengembalian}}" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="keterangan_edit_{{$surat->id}}" class="form-label">Keterangan</label>
                            <textarea rows="5" name="keterangan" class="form-control" id="keterangan_edit_{{$surat->id}}">{{$surat->keterangan}}</textarea>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    flatpickr("#tanggal_edit_{{$surat->id}}", {
        dateFormat: "Y-m-d",
        defaultDate: "{{ $surat->tanggal }}",
    });
</script>
