<div class="modal fade" id="createData" tabindex="-1" aria-labelledby="modalCreate">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">Tambah Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/surat">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <div class="input-group">
                                    <input type="text" id="tanggal" class="form-control border-0 dash-filter-picker shadow" name='tanggal' required>
                                    <div class="input-group-text bg-primary border-primary text-white">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Masukkan nomor surat..." required>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" class="form-control" name="perihal" id="perihal" placeholder="Masukkan perihal surat..." required>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="pengirim_surat" class="form-label">Asal/Pengirim</label>
                            <input type="text" class="form-control" name="pengirim_surat" id="pengirim_surat" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control" name="tujuan_surat" id="tujuan" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="peminjaman" class="form-label">Peminjaman</label>
                            <input type="text" class="form-control" name="peminjaman" id="peminjaman" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="pengembalian" class="form-label">Pengembalian</label>
                            <input type="text" class="form-control" name="pengembalian" id="pengembalian" placeholder="">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea rows="5" name="keterangan" class="form-control" id="keterangan"></textarea>
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
    flatpickr("#tanggal", {
        dateFormat: "Y-m-d",
    });

    tinymce.init({
        selector: 'textarea',
        height: 200,
        plugins: 'anchor autolink charmap codesample emoticons link lists visualblocks wordcount checklist mediaembed casechange formatpainter pageembed permanentpen footnotes advtemplate advtable advcode powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        menubar: '',
        skin: "oxide-dark",
        content_css: "dark",
        toolbar: 'undo redo | bold italic underline strikethrough | link | align lineheight | checklist numlist bullist indent outdent | removeformat',
    });
</script>
