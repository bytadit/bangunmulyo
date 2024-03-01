<div class="modal fade" id="createDataInventaris" tabindex="-1" aria-labelledby="modalCreateInventaris">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateInventaris">Tambah Data Inventaris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('inventaris.store')}}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Masukkan nama barang...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" min="1" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder="Masukkan jumlah barang...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" placeholder="Masukkan harga satuan..." onkeyup="formatAngsuran(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12 mb-3">
                            <label for="kondisi_barang" class="form-label">Pilih Kondisi Barang <span style="color: red;">*</span></label>
                            <select class="form-control" id="kondisi_barang" data-choices data-choices-groups  data-placeholder="Pilih Kondisi" name="kondisi_barang">
                                <option value="">Pilih Kondisi Barang</option>
                                <optgroup label="Kondisi Barang">
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak</option>
                                </optgroup>
                            </select>
                        </div>
                        {{-- <div class="col-lg-12">
                            <div>
                                <label for="deskripsi_barang" class="form-label">Deskripsi Barang</label>
                                <input type="text" class="form-control" name="deskripsi_barang" id="deskripsi_barang" placeholder="Masukkan deskripsi barang...">
                            </div>
                        </div><!--end col--> --}}
                        <div class="col-lg-12">
                            <label for="deskripsi_barang" class="form-label">Deskripsi Barang<span style="color: red;">*</span></label>
                            <textarea rows="3" name="deskripsi_barang" class="form-control" id="deskripsi_barang"></textarea>
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
