<div class="modal fade" id="createDataPeminjamSingle" tabindex="-1" aria-labelledby="modalCreatePeminjamSingle">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreatePeminjamSingle">Tambah Data Peminjam Perorangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('peminjam-single.store')}}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="nama" class="form-label">Nama Peminjam</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="no_hp" class="form-label">Nomor HandPhone Peminjam</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="nama_dusun" class="form-label">Nama Dusun Peminjam</label>
                                <input type="text" class="form-control" name="nama_dusun" id="nama_dusun" placeholder="Masukkan nama dusun peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="alamat" class="form-label">Alamat Peminjam<span style="color: red;">*</span></label>
                            <textarea rows="3" name="alamat" class="form-control" id="alamat"></textarea>
                        </div>
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
