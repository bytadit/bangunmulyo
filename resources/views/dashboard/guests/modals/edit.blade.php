<div class="modal fade" id="editData{{$guest->id}}" tabindex="-1" aria-labelledby="modalEdit{{$guest->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$guest->id}}">Ubah Data Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="/guests/{{$guest->id}}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="guest_id" value="{{$guest->id}}">
                        <div class="col-lg-12">
                            <div>
                                <label for="ename{{$guest->id}}" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{$guest->name}}" name="ename" id="ename{{$guest->id}}" placeholder="Masukkan nama lengkap...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="eidentity_number{{$guest->id}}" class="form-label">Nomor Identitas (NIP/NIM)</label>
                                <input type="text" class="form-control" value="{{$guest->identity_number}}" name="eidentity_number" id="eidentity_number{{$guest->id}}" placeholder="Masukkan nomor identitas...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label class="form-label">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->gender == 1 ? 'checked' : ''}} type="radio" name="egender" id="egenderMale{{$guest->id}}" value="1">
                                    <label class="form-check-label" for="egenderMale{{$guest->id}}">Pria</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->gender == 2 ? 'checked' : ''}} type="radio" name="egender" id="egenderFemale{{$guest->id}}" value="2">
                                    <label class="form-check-label" for="egenderFemale{{$guest->id}}">Wanita</label>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="eemail{{$guest->id}}" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{$guest->email}}" name="eemail" id="eemail{{$guest->id}}" placeholder="Masukkan email anda...">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label class="form-label">Kategori Tamu</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->guest_category == 1 ? 'checked' : ''}} type="radio" name="eguest_category" id="eguestMahasiswa{{$guest->id}}" value="1">
                                    <label class="form-check-label" for="eguestMahasiswa{{$guest->id}}">Mahasiswa</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->guest_category == 2 ? 'checked' : ''}} type="radio" name="eguest_category" id="eguestDosen{{$guest->id}}" value="2">
                                    <label class="form-check-label" for="eguestDosen{{$guest->id}}">Dosen</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->guest_category == 3 ? 'checked' : ''}} type="radio" name="eguest_category" id="eguestStaff{{$guest->id}}" value="3">
                                    <label class="form-check-label" for="eguestStaff{{$guest->id}}">Staff</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$guest->guest_category == 4 ? 'checked' : ''}} type="radio" name="eguest_category" id="eguestOthers{{$guest->id}}" value="4">
                                    <label class="form-check-label" for="eguestOthers{{$guest->id}}">Lainnya</label>
                                </div>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="ephone{{$guest->id}}" class="form-label">No Telepon/Whatsapp</label>
                                <input type="text" class="form-control" value="{{$guest->phone}}" name="ephone" id="ephone{{$guest->id}}" placeholder="Masukkan nomor yang bisa dihubungi...">
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
