<div class="modal fade" id="showInfoPinjaman{{ $pinjaman->id }}" tabindex="-1" aria-labelledby="modalShowInfoPinjaman">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowInfoPinjaman">Detail Pinjaman Kelompok {{ $kelompok_name }} Periode Ke - {{ $pinjaman->periode_pinjaman }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Keterangan</div>
                    <div class="col-sm-7">: {{ $pinjaman->keterangan == 1 ? 'Lunas' : 'Belum Lunas' }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Nilai Peminjaman</div>
                    <div class="col-sm-7">: @currency($pinjaman->jumlah_pinjaman)</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Nilai Angsuran</div>
                    <div class="col-sm-7">:  @currency($pinjaman->jumlah_angsuran)</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Nilai Pokok Yang Dibayarkan</div>
                    <div class="col-sm-7">:  @currency($pinjaman->jumlah_pokok)</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Nilai Iuran/Jasa</div>
                    <div class="col-sm-7">: @currency($pinjaman->jumlah_iuran)</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Jangka Waktu</div>
                    <div class="col-sm-7">: {{ $pinjaman->jangka_waktu }} Bulan</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Tanggal Peminjaman</div>
                    <div class="col-sm-7">: {{ \Carbon\Carbon::parse($pinjaman->tgl_pinjaman)->isoFormat('D MMMM Y') }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Tanggal Jatuh Tempo</div>
                    <div class="col-sm-7">: {{ \Carbon\Carbon::parse($pinjaman->tgl_jatuh_tempo)->isoFormat('D MMMM Y') }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Tanggal Pencairan</div>
                    <div class="col-sm-7">: {{ $pinjaman->tgl_pencairan != null ? \Carbon\Carbon::parse($pinjaman->tgl_pencairan)->isoFormat('D MMMM Y') : 'Belum Diatur' }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Tanggal Pelunasan</div>
                    <div class="col-sm-7">: {{ $pinjaman->tgl_pelunasan != null ? \Carbon\Carbon::parse($pinjaman->tgl_pelunasan)->isoFormat('D MMMM Y') : 'Belum Diatur' }}</div>
                </div>
                <div class="row mb-3"> <!-- Added mb-3 class for margin-bottom -->
                    <div class="col-sm-5 fw-medium">Keperluan</div>
                    <div class="col-sm-7">: {{ $pinjaman->keperluan }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
