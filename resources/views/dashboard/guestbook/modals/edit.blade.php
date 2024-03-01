<div class="modal fade" id="editData{{$guest_book->id}}" tabindex="-1" aria-labelledby="modalEdit{{$guest_book->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEdit{{$guest_book->id}}">Ubah Data Riwayat Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="{{route('guestbook.update', $guest_book->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <input type="hidden" name="guestbook_id" value="{{$guest_book->id}}">
                        <div class="col-lg-12 mb-3">
                            <label for="guest_id" class="form-label">Pilih Tamu <span style="color: red;">*</span></label>
                            <select class="form-select" id="guest_id" data-placeholder="Pilih Tamu" name="guest_id">
                                <option>Pilih Tamu</option>
                                <!-- <optgroup label="NIM/NIP"> -->
                                    @foreach($guests as $guest)
                                        <option value="{{$guest->id}}" @if ($guest->id == $guest_book->guest_id) selected @endif>{{$guest->identity_number}} - {{$guest->name}}</option>
                                    @endforeach
                                <!-- </optgroup> -->
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="unit_id" class="form-label">Pilih Unit <span style="color: red;">*</span></label>
                            <select class="form-select" id="unit_id" data-placeholder="Pilih Unit" name="unit_id">
                                <option>Pilih Unit/Fakultas/Prodi</option>
                                <!-- <optgroup label="Unit/Fakultas/Prodi"> -->
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" @if ($unit->id == $guest_book->unit_id) selected @endif>{{$unit->display_name}}</option>
                                    @endforeach
                                <!-- </optgroup> -->
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="problem_category_id" class="form-label">Keperluan <span style="color: red;">*</span></label>
                            <select id="problem_category_id" class="form-select mb-3" name="problem_category_id" aria-label="Default select example">
                                <option>Pilih Keperluan</option>
                                @foreach($problems as $problem)
                                    <option value="{{$problem->id}}" @if($guest_book->problem_category_id == $problem->id) selected @endif>{{$problem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label for="description" class="form-label">Detail Keperluan <span style="color: red;">*</span></label>
                            {{--                                <textarea class="ckeditor-classic" name="description" id="description"></textarea>--}}
                            <textarea rows="5" name="description" class="form-control" id="description">{{$guest_book->description}}</textarea>
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
