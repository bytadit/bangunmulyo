<div class="modal fade" id="editData{{$invent->id}}" tabindex="-1" aria-labelledby="modalEdit{{$invent->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$invent->id}}">Ubah Data Inventaris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('inventaris.update', ['inventari' => $invent->id])}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="inventaris_id" value="{{$invent->id}}">
                        <input type="hidden" name="etgl_pembukuan" value="{{$invent->tgl_pembukuan}}">
                        <input type="hidden" name="ekode_barang" value="{{$invent->kode}}">
                        <div class="col-lg-12">
                            <div>
                                <label for="enama_barang" class="form-label">Nama Barang</label>
                                <input type="text" value="{{$invent->nama}}" class="form-control" name="enama_barang" id="enama_barang" placeholder="Masukkan nama barang...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="ejumlah_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" value="{{$invent->jumlah}}" min="1" class="form-control" name="ejumlah_barang" id="ejumlah_barang" placeholder="Masukkan jumlah barang...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="eharga_satuan" class="form-label">Harga Satuan</label>
                                <input type="text" value="{{$invent->harga_satuan}}" class="form-control" name="eharga_satuan" id="eharga_satuan" placeholder="Masukkan harga satuan..." onkeyup="formatAngsuran(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12 mb-3">
                            <label for="ekondisi_barang" class="form-label">Pilih Kondisi Barang <span style="color: red;">*</span></label>
                            <select class="form-control" id="ekondisi_barang"  name="ekondisi_barang">
                                <option value="">Pilih Kondisi Barang</option>
                                <optgroup label="Kondisi Barang">
                                    <option value="1" {{$invent->kondisi == 1 ? 'selected' : ''}}>Baik</option>
                                    <option value="2" {{$invent->kondisi == 2 ? 'selected' : ''}}>Rusak</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="edeskripsi_barang" class="form-label">Deskripsi Barang<span style="color: red;">*</span></label>
                            <textarea rows="3" name="edeskripsi_barang" class="form-control" id="edeskripsi_barang">{{$invent->deskripsi_barang}}</textarea>
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
