<div class="modal fade" id="showInfoSingle{{ $single->id }}" tabindex="-1" aria-labelledby="modalShowInfoSingle">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowInfoSingle">Detail Informasi Kelompok {{ $single->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nama Peminjam</div>
                    <div class="col-sm-9">: {{ $single->nama }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nomor HandPhone</div>
                    <div class="col-sm-9">: {{ $single->noHP }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Nama Dusun</div>
                    <div class="col-sm-9">: {{ $single->nama_dusun }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Alamat</div>
                    <div class="col-sm-9">: {{ $single->alamat }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-3 fw-medium">Total Pinjaman</div>
                    <div class="col-sm-9">: {{ $pinjamans->where('peminjam_id', $single->id)->count() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
