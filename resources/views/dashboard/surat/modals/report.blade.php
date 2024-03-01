<div class="modal fade" id="createReport" tabindex="-1" aria-labelledby="modalReport">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreate">Generate Ekspedisi Surat Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('surat_export')}}">
                    @csrf
                    <div class="row g-3">
                        <label for="getDataBtn" class="form-label">Pilih Tanggal</label>
                        <div class="row g-3 mb-3 mt-0 align-items-center">
                            <div class="col-sm-auto mt-0">
                                <div class="input-group">
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $weekStartDate = $now->startOfYear()->format('d-M-Y');
                                        $weekEndDate = $now->endOfYear()->format('d-M-Y');
                                    @endphp
                                    <input type="text" name="tanggal"
                                           class="form-control border-0 dash-filter-picker shadow"
                                           data-provider="flatpickr" data-range-date="true"
                                           data-date-format="d-M-Y"
                                           data-deafult-date="{{ $weekStartDate }} to {{ $weekEndDate }}">
                                           <!-- data-deafult-date="01 Jan 2022 to 31 Jan 2022"> -->
                                    <div
                                        class="input-group-text bg-primary border-primary text-white">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submit-btn" value="false">Generate</button>
                            </div>
                        </div><!--end col-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
