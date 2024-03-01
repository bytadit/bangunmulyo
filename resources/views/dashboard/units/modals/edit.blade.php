<div class="modal fade" id="editData{{$unit->id}}" tabindex="-1" aria-labelledby="modalEdit{{$unit->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$unit->id}}">Ubah Data Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/units/{{$unit->id}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="unit_id" value="{{$unit->id}}">
                        {{-- <div class="col-lg-12">
                            <div>
                                <label for="eid" class="form-label">ID Unit</label>
                                <input type="text" class="form-control" value="{{$unit->name}}" name="eid" id="eid" placeholder="Masukkan id unit..." disabled>
                            </div>
                        </div><!--end col--> --}}
                        <div class="col-lg-12">
                            <div>
                                <label for="ename" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control" value="{{$unit->display_name}}" name="ename" id="ename" placeholder="Masukkan nama unit...">
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
