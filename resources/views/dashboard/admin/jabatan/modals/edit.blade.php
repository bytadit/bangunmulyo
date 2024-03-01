<div class="modal fade" id="editData{{$jabatan->id}}" tabindex="-1" aria-labelledby="modalEdit{{$jabatan->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$jabatan->id}}">Ubah Data Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('jabatan.update', ['jabatan' => $jabatan->id])}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="jabatan_id" value="{{$jabatan->id}}">
                        <div class="col-lg-12">
                            <div>
                                <label for="enama_jabatan" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" value="{{$jabatan->nama_jabatan}}" name="enama_jabatan" id="enama_jabatan" placeholder="Masukkan nama jabatan...">
                            </div>
                        </div><!--end col-->
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
