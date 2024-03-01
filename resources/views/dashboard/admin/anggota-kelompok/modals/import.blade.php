<div class="modal fade" id="importDataAnggotaKelompok" tabindex="-1" aria-labelledby="modalImportAnggotaKelompok">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportAnggotaKelompok">Impor File Data Anggota Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('import-anggota', ['kelompok' => $kelompok]) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="file">Pilih File Excel</label>
                            <input type="file" class="form-control-file" id="file" name="file">
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
