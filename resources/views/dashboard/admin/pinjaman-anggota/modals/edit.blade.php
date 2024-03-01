<div class="modal fade" id="editDataPinjamanAnggota{{ $pinjaman_anggota->id }}" tabindex="-1" aria-labelledby="modalEditPinjamanAnggota{{ $pinjaman_anggota->id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPinjamanAnggota{{ $pinjaman_anggota->id }}">Ubah Pinjaman Anggota </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('pinjaman-anggota.update', ['kelompok' => $kelompok, 'pinjaman_kelompok' => $pinjaman_kelompok, 'pinjaman_anggotum' => $pinjaman_anggota->id]) }}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_kelompok }}">
                        <input type="hidden" name="kelompok_id" value="{{ $kelompok }}">
                        <input type="hidden" name="pinjaman_anggota_id" value="{{ $pinjaman_anggota->id }}">
                        <input type="hidden" name="eanggota_id" value="{{ $pinjaman_anggota->anggota_id }}">
                        <h6 class="fs-15 mb-1">
                            Jangka Waktu : {{ $pinjaman->first()->jangka_waktu }} Bulan
                        </h6>
                        <div class="col-lg-12">
                            <div>
                                <label for="ejumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                                <input type="text" value="{{ $pinjaman_anggota->jumlah_pinjaman }}" class="form-control" name="ejumlah_pinjaman" onkeyup="formatAngsuran(this)"
                                    id="ejumlah_pinjaman" placeholder="Masukkan jumlah pinjaman...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="enilai_angsuran" class="form-label">Nilai Angsuran</label>
                                <input type="text" value="{{ $pinjaman_anggota->nilai_angsuran }}" class="form-control" name="enilai_angsuran" onkeyup="formatAngsuran(this)"
                                    id="enilai_angsuran" placeholder="Masukkan nilai angsuran...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="ejaminan" class="form-label">Jaminan</label>
                                <input type="text" value="{{ $pinjaman_anggota->jaminan }}" class="form-control" name="ejaminan"
                                    id="ejaminan" placeholder="Masukkan jaminan...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="enilai_jaminan" class="form-label">Nilai Jaminan</label>
                                <input type="text" value="{{ $pinjaman_anggota->nilai_jaminan }}" class="form-control" name="enilai_jaminan" onkeyup="formatAngsuran(this)"
                                    id="enilai_jaminan" placeholder="Masukkan nilai jaminan...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12 mb-3">
                            <label for="eketerangan" class="form-label">Keterangan (opsional)<span style="color: red;">*</span></label>
                            <textarea rows="3" name="eketerangan" class="form-control" id="eketerangan">{{ $pinjaman_anggota->keterangan }}</textarea>
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
<script>
    function formatAngsuran(input) {
        // Remove non-numeric characters, except leading zeros
        var value = input.value.replace(/^0+/, ''); // Remove leading zeros
        value = value.replace(/\D/g, ''); // Remove non-digits

        // Format the number with thousands separator and a period for decimal
        var formattedValue = new Intl.NumberFormat('id-ID').format(value);

        // Update the input value
        input.value = formattedValue;
    }
</script>
