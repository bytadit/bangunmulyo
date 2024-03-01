<div class="modal fade" id="showInfoKelompok{{ $kelompok->id }}" tabindex="-1" aria-labelledby="modalShowInfoKelompok">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowInfoKelompok">Detail Informasi Kelompok {{ $kelompok->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nama Kelompok</div>
                    <div class="col-sm-9">: {{ $kelompok->nama }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nomor HandPhone</div>
                    <div class="col-sm-9">: {{ $kelompok->noHP }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nama Dusun</div>
                    <div class="col-sm-9">: {{ $kelompok->nama_dusun }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Alamat</div>
                    <div class="col-sm-9">: {{ $kelompok->alamat }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Ketua Kelompok</div>
                    <div class="col-sm-9">: {{ $anggotas->where('kelompok_id', $kelompok->id)->where('jabatan_id', 1)->count() > 0 ? $anggotas->where('kelompok_id', $kelompok->id)->where('jabatan_id', 1)->first()->nama : 'Belum Diatur' }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Jumlah Anggota</div>
                    <div class="col-sm-9">: {{ $anggotas->where('kelompok_id', $kelompok->id)->count() }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Total Pinjaman</div>
                    <div class="col-sm-9">: {{ $pinjamans->where('peminjam_id', $kelompok->id)->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
