<div class="modal fade" id="createDataPinjaman" tabindex="-1" aria-labelledby="modalCreatePinjaman">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="modalCreatePinjaman">Tambah Data Pinjaman Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('pinjaman-kelompok.store', ['kelompok' => $kelompok])}}">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="peminjam_id" value="{{ $kelompok }}">
                        <div class="col-lg-12">
                            <div>
                                <label for="tgl_pinjaman" class="form-label">Tanggal Pinjaman</label>
                                <input type="date" class="form-control" name="tgl_pinjaman" id="tgl_pinjaman" placeholder="Masukkan tanggal pinjaman...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="tgl_pencairan" class="form-label">Tanggal Pencairan</label>
                                <input type="date" class="form-control" name="tgl_pencairan" id="tgl_pencairan" placeholder="Masukkan tanggal pencairan...">
                            </div>
                        </div><!--end col-->
                        {{-- <div class="col-lg-12">
                            <div>
                                <label for="jangka_waktu" class="form-label">Jangka Waktu (Bulan)</label>
                                <input type="number" min="1" class="form-control" name="jangka_waktu" id="jangka_waktu" placeholder="Masukkan jangka waktu pinjaman (bulan)...">
                            </div>
                        </div><!--end col--> --}}

                        <div class="col-lg-12">
                            <label for="keperluan" class="form-label">Keperluan<span style="color: red;">*</span></label>
                            <textarea rows="3" name="keperluan" class="form-control" id="keperluan"></textarea>
                        </div>
                        {{-- <div class="col-lg-12 mb-3">
                            <label for="keterangan" class="form-label">Pilih Keterangan<span style="color: red;">*</span></label>
                            <select class="form-control" id="keterangan" name="keterangan">
                                <option value="">Pilih Keterangan</option>
                                <optgroup label="Keterangan">
                                    <option value="0">Belum Lunas</option>
                                    <option value="1">Lunas</option>
                                </optgroup>
                            </select>
                        </div> --}}
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
