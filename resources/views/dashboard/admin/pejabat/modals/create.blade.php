<div class="modal fade" id="createDataPejabat" tabindex="-1" aria-labelledby="modalCreatePejabat">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreatePejabat">Tambah Data Pejabat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('pejabat.store')}}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-lg-12 mb-3">
                            <label for="user_id" class="form-label">Pilih Staff <span style="color: red;">*</span></label>
                            <select class="form-control" id="user_id" data-choices data-choices-groups  data-placeholder="Pilih Staff" name="user_id">
                                <option value="">Pilih Staff</option>
                                <optgroup label="Nama Staff">
                                    @foreach($staffs->whereNotIn('id', $pejabats->pluck('user_id')) as $staff)
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="jabatan_id" class="form-label">Pilih Jabatan <span style="color: red;">*</span></label>
                            <select class="form-control" id="jabatan_id" data-choices data-choices-groups  data-placeholder="Pilih Jabatan" name="jabatan_id">
                                <option value="">Pilih Jabatan</option>
                                <optgroup label="Nama Jabatan">
                                    @foreach($jabatans as $jabatan)
                                        <option value="{{$jabatan->id}}">{{$jabatan->nama_jabatan}}</option>
                                    @endforeach
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
