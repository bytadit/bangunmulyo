<div class="modal fade" id="editFullDataPinjaman" tabindex="-1" aria-labelledby="modalEditFullDataPinjaman">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditFullDataPinjaman">Ubah Detail Pinjaman Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('pinjaman-kelompok.update-full', ['kelompok' => $kelompok, 'pinjaman_kelompok' => $pinjaman_kelompok])}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="peminjam_id" value="{{ $kelompok }}">
                        <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_kelompok }}">
                        <input type="hidden" name="eperiode" value="{{ $pinjaman->first()->periode_pinjaman }}">
                        <div class="col-lg-12">
                            <div>
                                <label for="ejangka_waktu" class="form-label">Jangka Waktu (Bulan)</label>
                                <input type="number" min="1" value="{{ $pinjaman->first()->jangka_waktu }}" class="form-control" name="ejangka_waktu" id="ejangka_waktu" placeholder="Masukkan jangka waktu pinjaman (bulan)...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="etgl_pinjaman" class="form-label">Tanggal Pinjaman</label>
                                <input type="date" value="{{\Carbon\Carbon::parse($pinjaman->first()->tgl_pinjaman)->format('Y-m-d')}}" class="form-control" name="etgl_pinjaman" id="etgl_pinjaman" placeholder="Masukkan tanggal pinjaman...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="etgl_pencairan" class="form-label">Tanggal Pencairan</label>
                                <input type="date" value="{{\Carbon\Carbon::parse($pinjaman->first()->tgl_pencairan)->format('Y-m-d')}}" class="form-control" name="etgl_pencairan" id="etgl_pencairan" placeholder="Masukkan tanggal pencairan...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="etgl_pelunasan" class="form-label">Tanggal Pelunasan</label>
                                <input type="date" value="{{\Carbon\Carbon::parse($pinjaman->first()->tgl_pelunasan)->format('Y-m-d')}}" class="form-control" name="etgl_pelunasan" id="etgl_pelunasan" placeholder="Masukkan tanggal pinjaman...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="ekeperluan" class="form-label">Keperluan<span style="color: red;">*</span></label>
                            <textarea rows="3" name="ekeperluan" class="form-control" id="ekeperluan">{{ $pinjaman->first()->keperluan }}</textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="eketerangan" class="form-label">Pilih Keterangan<span style="color: red;">*</span></label>
                            <select class="form-control" id="eketerangan" name="eketerangan">
                                <option value="">Pilih Keterangan</option>
                                <optgroup label="Keterangan">
                                    <option value="0" {{ $pinjaman->first()->keterangan == 0 ? 'selected' : ''}}>Belum Lunas</option>
                                    <option value="1" {{ $pinjaman->first()->keterangan == 1 ? 'selected' : ''}}>Lunas</option>
                                </optgroup>
                            </select>
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
