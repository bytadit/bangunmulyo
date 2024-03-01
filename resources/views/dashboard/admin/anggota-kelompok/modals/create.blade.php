<div class="modal fade" id="createDataAnggotaKelompok" tabindex="-1" aria-labelledby="modalCreateAnggotaKelompok">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateAnggotaKelompok">Tambah Anggota Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="d-flex align-items-center fw-medium mb-3 mt-0">
                        <button type="button" class="btn btn-lg btn-primary mx-1" id="btn-input">
                            <i class="ri-user-add-line"></i> <span >@lang('Input Manual')</span>
                        </button>
                        <button type="button" class="btn btn-lg btn-soft-success mr-1" id="btn-import">
                            <i class="ri-database-2-line"></i> <span >@lang('Import File')</span>
                        </button>
                    </div>
                </div>
                <div class="import-data d-none" id="import-data">
                    <form method="post" enctype="multipart/form-data" action="{{ route('import-anggota', ['kelompok' => $kelompok]) }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <!-- Link to download Excel template file -->
                                <p>Download Template Sheet Anggota: <a href="{{ asset('templates/template-anggota.xlsx') }}">Template Anggota</a></p>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <label for="file">Choose Excel File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
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
                <div class="input-data" id="input-data">
                    <form method="post" enctype="multipart/form-data" action="{{ route('detail-kelompok.store', ['kelompok' => $kelompok]) }}">
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="peminjam_id" value="{{ $kelompok }}">
                            <div class="col-lg-12">
                                <div>
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik" id="nik"
                                        placeholder="Masukkan nik anggota...">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div>
                                    <label for="nama" class="form-label">Nama Anggota Kelompok</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan nama anggota...">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12 mb-3">
                                <label for="jenis_kelamin" class="form-label">Pilih Jenis Kelamin<span
                                        style="color: red;">*</span></label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <optgroup label="Pilih Jenis Kelamin">
                                        <option value="1">Laki-Laki</option>
                                        <option value="2">Perempuan</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="jabatan_id" class="form-label">Pilih Jabatan<span
                                        style="color: red;">*</span></label>
                                <select class="form-control" id="jabatan_id" name="jabatan_id">
                                    <option value="">Pilih Jabatan</option>
                                    <optgroup label="Pilih Jabatan">
                                        @foreach ($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="noHP" class="form-label">Nomor HP Anggota Kelompok</label>
                                    <input type="text" class="form-control" name="noHP" id="noHP"
                                        placeholder="Masukkan nomor handphone anggota...">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                        placeholder="Masukkan tanggal lahir...">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div>
                                    <label for="pekerjaan" class="form-label">Pekerjaan Anggota Kelompok</label>
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"
                                        placeholder="Masukkan pekerjaan anggota...">
                                </div>
                            </div><!--end col-->

                            <div class="col-lg-12">
                                <label for="alamat" class="form-label">Alamat<span
                                        style="color: red;">*</span></label>
                                <textarea rows="3" name="alamat" class="form-control" id="alamat"></textarea>
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
</div>
<script>
    $("#btn-import").on("click", function(){
            // $("#chosen_btn").val('new-data');
            $('#input-data').removeClass('d-block');
            $('#input-data').addClass('d-none');
            $('#btn-input').removeClass('btn-primary');
            $('#btn-input').addClass('btn-soft-primary');

            $('#import-data').removeClass('d-none');
            $('#btn-import').removeClass('btn-soft-success');
            $('#btn-import').addClass('btn-success');
            $('#import-data').addClass('d-block');
    });
    $("#btn-input").on("click", function(){
            // $("#chosen_btn").val('new-data');
            $('#import-data').removeClass('d-block');
            $('#import-data').addClass('d-none');
            $('#btn-import').removeClass('btn-success');
            $('#btn-import').addClass('btn-soft-success');

            $('#input-data').removeClass('d-none');
            $('#btn-input').removeClass('btn-soft-primary');
            $('#btn-input').addClass('btn-primary');
            $('#input-data').addClass('d-block');
    });

    // $("#db-search").on("click", function(){
    //     $("#chosen_btn").val('db-data');

    //     $('#new-data').removeClass('d-block');
    //     $('#new-data').addClass('d-none');
    //     $('#add-new').removeClass('btn-success');
    //     $('#add-new').addClass('btn-soft-success');

    //     $('#db-data').removeClass('d-none');
    //     $('#db-search').removeClass('btn-soft-primary');
    //     $('#db-search').addClass('btn-primary');
    //     $('#db-data').addClass('d-block');

    //     $('#detail-data').removeClass('d-none');
    //     $('#detail-data').addClass('d-block');
    // });
    // $("#submit-btn").on("click", function (){
    //     $("#submit_state").val(true);
    // })
</script>
