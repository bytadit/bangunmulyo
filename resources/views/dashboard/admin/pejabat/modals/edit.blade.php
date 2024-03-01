<div class="modal fade" id="editData{{$pejabat->id}}" tabindex="-1" aria-labelledby="modalEdit{{$pejabat->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$pejabat->id}}">Ubah Data Pejabat {{$pejabat->user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('pejabat.update', ['pejabat' => $pejabat->id])}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="pejabat_id" value="{{$pejabat->id}}">
                        <input type="hidden" name="euser_id" value="{{$pejabat->user_id}}">
                        <div class="col-lg-12 mb-3">
                            <label for="jabatan_id" class="form-label">Pilih Jabatan <span style="color: red;">*</span></label>
                            <select class="form-control" id="ejabatan_id" name="ejabatan_id">
                                <option value="">Pilih Jabatan</option>
                                <optgroup label="Nama Jabatan">
                                    @foreach($jabatans as $jabatan)
                                        <option value="{{$jabatan->id}}" {{$jabatan->id == $pejabat->jabatan_id ? 'selected' : ''}}>{{$jabatan->nama_jabatan}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
