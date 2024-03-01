<div class="modal fade" id="createData" tabindex="-1" aria-labelledby="modalCreate">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">Tambah Data Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/units">
                    @csrf
                    <div class="row g-3">
                        {{-- <div class="col-lg-12">
                            <div>
                                <label for="name" class="form-label">ID Unit</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan id unit...">
                            </div>
                        </div><!--end col--> --}}
                        <div class="col-lg-12">
                            <div>
                                <label for="display_name" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Masukkan nama unit...">
                            </div>
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
