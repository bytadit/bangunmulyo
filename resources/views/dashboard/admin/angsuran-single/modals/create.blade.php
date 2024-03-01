<div class="modal fade" id="createDataAngsuranSingle" tabindex="-1" aria-labelledby="modalCreateDataAngsuranSingle">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateDataAngsuranSingle">Tambah Riwayat Angsuran Perorangan
                    {{ $single_name }} Periode ke - {{ $periode }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data"
                    action="{{ route('riwayat-angsuran-single.store', ['single' => $single, 'pinjaman_single' => $pinjaman_single]) }}">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="single_id" value="{{ $single }}">
                        <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_single }}">
                        <div class="col-lg-12">
                            <div>
                                <label for="tgl_angsuran" class="form-label">Tanggal Angsuran</label>
                                <input type="date" class="form-control" value="{{\Carbon\Carbon::parse($last_angsuran)->format('Y-m-d')}}" name="tgl_angsuran" id="tgl_angsuran"
                                    placeholder="Masukkan tanggal angsuran...">
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
                                <label for="angsuran_dibayarkan" class="form-label">Angsuran Dibayarkan</label>
                                <input type="text" class="form-control" onkeyup="formatAngsuran(this)" name="angsuran_dibayarkan" id="angsuran_dibayarkan"
                                    placeholder="Masukkan angsuran dibayarkan...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="keterangan" class="form-label">Keterangan<span style="color: red;">*</span></label>
                            <textarea rows="3" name="keterangan" class="form-control" id="keterangan"></textarea>
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
