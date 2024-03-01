<div class="modal fade" id="editDataAngsuranSingle{{ $angsuran->id }}" tabindex="-1" aria-labelledby="modalEditDataAngsuranSingle">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDataAngsuranSingle">Ubah Riwayat Angsuran Perorangan
                    {{ $single_name }} Periode ke - {{ $periode }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data"
                    action="{{ route('riwayat-angsuran-single.update', ['single' => $single, 'pinjaman_single' => $pinjaman_single, 'riwayat_angsuran_single' => $angsuran->id]) }}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="single_id" value="{{ $single }}">
                        <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_single }}">
                        <input type="hidden" name="angsuran_id" value="{{ $angsuran->id }}">
                        <input type="hidden" name="angsuran_ke" value="{{ $angsuran->angsuran_ke }}">

                        <div class="col-lg-12">
                            <div>
                                <label for="etgl_angsuran" class="form-label">Tanggal Angsuran</label>
                                <input type="date" class="form-control" name="etgl_angsuran" id="etgl_angsuran"
                                    placeholder="Masukkan tanggal angsuran..." value="{{\Carbon\Carbon::parse($angsuran->tgl_angsuran)->format('Y-m-d')}}">
                            </div>
                        </div><!--end col-->
                        {{-- <div class="col-lg-12">
                            <div>
                                <label for="iuran" class="form-label">Iuran</label>
                                <input type="number" min="1" class="form-control" name="iuran" id="iuran"
                                    placeholder="Masukkan iuran...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="pokok" class="form-label">Pokok Dibayarkan</label>
                                <input type="number" min="1" class="form-control" name="pokok" id="pokok"
                                    placeholder="Masukkan pokok dibayar...">
                            </div>
                        </div><!--end col--> --}}
                        <div class="col-lg-12">
                            <div>
                                <label for="eangsuran_dibayarkan" class="form-label">Angsuran Dibayarkan</label>
                                <input type="text" value="{{ $angsuran->angsuran_dibayarkan }}" class="form-control" name="eangsuran_dibayarkan" id="eangsuran_dibayarkan" onkeyup="formatAngsuran(this)"
                                    placeholder="Masukkan angsuran dibayarkan...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="eketerangan" class="form-label">Keterangan<span style="color: red;">*</span></label>
                            <textarea rows="3" name="eketerangan" class="form-control" id="eketerangan">{{ $angsuran->keterangan }}</textarea>
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
