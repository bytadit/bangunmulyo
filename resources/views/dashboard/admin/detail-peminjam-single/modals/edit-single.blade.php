<div class="modal fade" id="editDataSingle" tabindex="-1" aria-labelledby="modalEditSingle">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSingle">Ubah Data Peminjam Perorangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('peminjam-single.update', ['peminjam_single' => $single])}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="peminjam_id" value="{{$single}}">
                        <input type="hidden" name="ejenis_peminjam" value="{{$singles->first()->jenis_peminjam}}">
                        <div class="col-lg-12">
                            <div>
                                <label for="nama" class="form-label">Nama Peminjam</label>
                                <input type="text" value="{{$singles->first()->nama}}" class="form-control" name="enama" id="nama" placeholder="Masukkan nama peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="no_hp" class="form-label">Nomor HandPhone</label>
                                <input type="text" value="{{$singles->first()->noHP}}" class="form-control" name="eno_hp" id="no_hp" placeholder="Masukkan nomor HP peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="nama_dusun" class="form-label">Nama Dusun</label>
                                <input type="text" value="{{$singles->first()->nama_dusun}}" class="form-control" name="enama_dusun" id="nama_dusun" placeholder="Masukkan nama dusun peminjam...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="alamat" class="form-label">Alamat Peminjam<span style="color: red;">*</span></label>
                            <textarea rows="3" name="ealamat" class="form-control" id="alamat">{{$singles->first()->alamat}}</textarea>
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
