<div class="modal fade" id="editDataAnggotaKelompok{{ $anggota->id }}" tabindex="-1" aria-labelledby="modalEditAnggotaKelompok">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAnggotaKelompok">Ubah Data Anggota Kelompok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('detail-kelompok.update', ['kelompok' => $kelompok, 'detail_kelompok' => $anggota->id]) }}">
                    @csrf
                    @method('put')
                    <div class="row g-3">
                        <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">
                        <input type="hidden" name="peminjam_id" value="{{ $kelompok }}">
                        <div class="col-lg-12">
                            <div>
                                <label for="enik" class="form-label">NIK</label>
                                <input type="text" value="{{ $anggota->nik }}" class="form-control" name="enik" id="enik"
                                    placeholder="Masukkan nik anggota...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="enama" class="form-label">Nama Anggota Kelompok</label>
                                <input type="text" value="{{ $anggota->nama }}" class="form-control" name="enama" id="enama"
                                    placeholder="Masukkan nama anggota...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12 mb-3">
                            <label for="ejenis_kelamin" class="form-label">Pilih Jenis Kelamin<span
                                    style="color: red;">*</span></label>
                            <select class="form-control" id="ejenis_kelamin" name="ejenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                <optgroup label="Pilih Jenis Kelamin">
                                    <option value="1" {{ $anggota->jenis_kelamin == 1 ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="2" {{ $anggota->jenis_kelamin == 2 ? 'selected' : '' }}>Perempuan</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="ejabatan_id" class="form-label">Pilih Jabatan<span
                                    style="color: red;">*</span></label>
                            <select class="form-control" id="ejabatan_id" name="ejabatan_id">
                                <option value="">Pilih Jabatan</option>
                                <optgroup label="Pilih Jabatan">
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}" {{ $anggota->jabatan_id == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama_jabatan }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="enoHP" class="form-label">Nomor HP Anggota Kelompok</label>
                                <input type="text" value="{{ $anggota->noHP }}" class="form-control" name="enoHP" id="enoHP"
                                    placeholder="Masukkan nomor handphone anggota...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="etgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" value="{{\Carbon\Carbon::parse($anggota->tgl_lahir)->format('Y-m-d')}}" class="form-control" name="etgl_lahir" id="etgl_lahir"
                                    placeholder="Masukkan tanggal lahir...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="epekerjaan" class="form-label">Pekerjaan Anggota Kelompok</label>
                                <input type="text" value="{{ $anggota->pekerjaan }}" class="form-control" name="epekerjaan" id="epekerjaan"
                                    placeholder="Masukkan pekerjaan anggota...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="ealamat" class="form-label">Alamat<span
                                    style="color: red;">*</span></label>
                            <textarea rows="3" name="ealamat" class="form-control" id="ealamat">{{ $anggota->alamat }}</textarea>
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
