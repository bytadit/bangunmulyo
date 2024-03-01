<div class="modal fade" id="editData{{$category->id}}" tabindex="-1" aria-labelledby="modalEdit{{$category->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$category->id}}">Ubah Data Kategori Keperluan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/problems/{{$category->id}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="col-lg-12">
                            <div>
                                <label for="ename" class="form-label">Nama Kategori Keperluan</label>
                                <input type="text" class="form-control" value="{{$category->name}}" name="ename" id="ename" placeholder="Masukkan nama kategori keperluan...">
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
