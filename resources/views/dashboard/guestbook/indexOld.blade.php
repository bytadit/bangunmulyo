<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/datatables/1.10.24/css/dataTables.bootstrap4.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="{{asset('/js/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/datatables/1.10.24/js/jquery.dataTables.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.min.css')}}">
    <script src="{{asset('/datatables/1.10.24/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/fontawesome/all.min.js')}}"></script>
    <title>Daftar Tamu UPT TIK UNS</title>
  </head>
  <body>
    @include("navbar")

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="mt-3 text-center title">Daftar Tamu UPT TIK UNS</h1>
        <div class="text-center">
          <a class="btn btn-lg btn-primary my-3 btnAddGuest" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-user-plus"></i> Tambah Tamu</a>
        </div>
        <a href="{{url('/export-data')}}" class="btn btn-warning mb-2 btnDownload"><i class="fas fa-file-export"></i> Ekspor Data Tamu</a>
        <!-- <a href="{{url('/category-description')}}" class="btn btn-success mb-2"> Kategori Keperluan</a> -->

          {{-- MODAL TAMBAH DATA --}}
        <div class="modal fade" id="modal-tambah" aria-labelledby="tambahModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="/">
                  @csrf
                  <div class="form-group">
                    <label for="nip">NIP / NIM</label>
                    <div class="d-flex flex-row">
                      <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="Masukkan nip/nim" name="nip" value="{{old('nip')}}">
                      <button class="btn btn-primary ml-4 get-data-mhs" type="button" style="height: 40px; width:120px;">Get Data</button>
                    </div>
                    @error('nip')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Masukkan nama" name="name" value="{{old('name')}}">
                    @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="unit">Unit/Instansi</label>
                    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Masukkan unit" name="unit" value="{{old('unit')}}">
                    @error('unit')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone">No. HP / Telepon</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Masukkan phone" name="phone" value="{{old('phone')}}">
                    @error('phone')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description_id_add">Kategori Keperluan</label>
                    <select class="form-control @error('description_id') is-invalid @enderror select2" placeholder="Kategori Keperluan" name="description_id" value="{{old('description')}}" style="width: 100%; padding">
                        <option value=""></option>
                      @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    @error('description_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Keperluan</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Keterangan kegiatan" name="description" value="{{old('description')}}">
                    @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  {{-- BUTTON --}}
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        {{-- END MODAL TAMBAH DATA --}}
        @if (session('tambah'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('tambah') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('update') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif (session('hapus'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('hapus') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <table class="table cell-border compact stripe display table-light" id="guest-datatable" style="width:100%">
          <thead class="thead-dark">
              <tr>
                  <th scope="col" class="tableNumber">No</th>
                  <th scope="col" class="tableDate">Tanggal</th>
                  <th scope="col" class="tableName">Nama</th>
                  <th scope="col">Unit</th>
                  <th scope="col" class="tablePhone">No. Telepon</th>
                  <th scope="col" class="tableCategory">Kategori Keperluan</th>
                  <th scope="col" class="tableDescription">Keperluan</th>
                  <th scope="col" class="tableAction" style="width: 250px;">Aksi</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($guests as $guest)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$guest->created_at->format('d-m-Y H:i')}}</td>
                    <td>{{$guest->nama}}</td>
                    <td>{{$guest->unit}}</td>

		    <!-- SENSOR NOMOR TELEPON -->
                    <td>{{ substr($guest->phone, 0, strlen($guest->phone) - 3) . 'xxx' }}</td>
		    <!-- END SENSOR NOMOR TELEPON -->

                    <td>{{$guest->categoryDescription->name}}</td>
                    <td>{{$guest->description}}</td>
                    <td>
                      {{-- tombol detail --}}
                        <a id="detail" class="btn btn-secondary btn-info" data-toggle="modal" data-target="#modal-detail"
                        data-nama = "{{$guest->nama}}"
                        data-unit = "{{$guest->unit}}"
                        data-tanggal = "{{$guest->created_at}}"
                        data-category = "{{$guest->categoryDescription->name}}"
                        data-description = "{{$guest->description}}"
                        data-nip = "{{$guest->nip}}"
                        data-phone = "{{$guest->phone}}"
                        ><i class="fas fa-eye"></i></a>

                        {{-- tombol edit --}}
                        <a id="edit" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit"
                        data-id = "{{ $guest->id }}"
                        data-nama = "{{$guest->nama}}"
                        data-unit = "{{$guest->unit}}"
                        data-category = "{{$guest->categoryDescription->id}}"
                        data-description = "{{$guest->description}}"
                        data-nip = "{{$guest->nip}}"
                        data-phone = "{{$guest->phone}}"
                        ><i class="fas fa-edit"></i></a>

                        {{-- tombol hapus --}}
                        <form action="/{{$guest->id}}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin?')">
                          @method('delete')
                          @csrf
                          <button type="submit" class="btn btn-danger tombol-hapus"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
              @endforeach
              {{-- MODAL DETAIL --}}
              <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Detail Tamu</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h5 id="detail-nama"></h5>
                      <h6 class="mb-2 text-muted">Unit</h6>
                      <p id="detail-unit"></p>
                      <h6 class="mb-2 text-muted">Tanggal</h6>
                      <p id="detail-tanggal"></p>
                      <h6 class="mb-2 text-muted">NIP / NIM</h6>
                      <p id="detail-nip"></p>
                      <h6 class="mb-2 text-muted">No. Telepon / HP</h6>
                      <p id="detail-phone"></p>
                      <h6 class="mb-2 text-muted">Kategori Keperluan</h6>
                      <p id="detail-category-description"></p>
                      <h6 class="mb-2 text-muted">Keperluan</h6>
                      <p id="detail-description"></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                  </div>
                </div>
              </div>
              {{-- END MODAL DETAIL --}}

              {{-- MODAL EDIT DATA --}}
              <div class="modal fade" id="modal-edit" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahModalLabel">Form Edit Tamu</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/" method="post" id="editForm">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label for="enip">NIP / NIM</label>
                          <div class="d-flex flex-row">
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" id="enip" placeholder="Masukkan nip" name="nip" value="{{old('nip')}}">
                            <button class="btn btn-primary ml-4 get-data-mhs-edit" type="button" style="height: 40px; width:120px;">Get Data</button>
                          </div>                          @error('enip')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="enama">Nama</label>
                          <input type="text" class="form-control @error('enama') is-invalid @enderror" id="enama" placeholder="Masukkan nama" name="enama">
                          @error('enama')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        <div class="form-group">
                          <label for="eunit">Unit/Instansi</label>
                          <input type="text" class="form-control @error('eunit') is-invalid @enderror" id="eunit" placeholder="Masukkan unit" name="eunit">
                          @error('eunit')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="ephone">No. HP / Telepon</label>
                          <input type="text" class="form-control @error('ephone') is-invalid @enderror" id="ephone" placeholder="Masukkan nama" name="ephone">
                          @error('ephone')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="description_id_edit">Kategori Keperluan</label>
                          <select class="form-control @error('description_id') is-invalid @enderror select2" id="edescription_id"  placeholder="Kategori Keperluan" name="edescription_id" value="{{old('description')}}" style="width: 100%; padding">
                            {{-- {{ $category->id == $description ? 'selected' : '' }} --}}
                              <option value=""></option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                            @endforeach
                          </select>
                          @error('description_id')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="edescription">Keperluan</label>
                          <input type="text" class="form-control @error('edescription') is-invalid @enderror" id="edescription" placeholder="Keterangan kegiatan" name="edescription">
                          @error('edescription')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>

                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Update Data</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              {{-- END MODAL EDIT DATA --}}
          </tbody>
      </table>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ asset('/js/pddikti/index.js') }}"></script>

{{-- DATATABLE --}}
<script>
    $(document).ready(function() {
    $('#guest-datatable').DataTable();
} );
</script>

<script>
  $(document).ready(function() {
    $('.get-data-mhs').on('click', async () => {
      const nim = $('#nip').val();
      const getData = await hitMahasiswa(nim);
      $('#nama').val(getData.data.nama);
      $('#unit').val(getData.data.prodi);
    });

    $('.get-data-mhs-edit').on('click', async () => {
      const nim = $('#enip').val();
      const getData = await hitMahasiswa(nim);
      $('#enama').val(getData.data.nama);
      $('#eunit').val(getData.data.prodi);
    });
} );
</script>

{{-- SELECT2 --}}
<script>
  $(document).ready(function() {
    $('.select2').select2({
      placeholder: "Kategori Keperluan",
      allowClear: true,
    });
  });
</script>

{{-- MODAL DETAIL --}}
<script>
  $(document).ready(function(){
    $(document).on('click', '#detail', function(){
      var nama = $(this).data('nama');
      var unit = $(this).data('unit');
      var tanggal = $(this).data('tanggal');
      var category = $(this).data('category');
      var description = $(this).data('description');
      var nip = $(this).data('nip');
      var phone = $(this).data('phone');

      phone = phone.substring(0, phone.length - 3) + 'xxx'

      $('#detail-nama').text(nama);
      $('#detail-unit').text(unit);
      $('#detail-tanggal').text(tanggal);
      $('#detail-category-description').text(category);
      $('#detail-description').text(description);
      $('#detail-nip').text(nip);
      $('#detail-phone').text(phone);
    })
  });
</script>

{{-- MODAL EDIT --}}
<script>
  $(document).ready(function(){
    $(document).on('click', '#edit', function(){
      // var $newOption = $("<option selected='selected'></option>").val("TheID").text("The text")

      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var unit = $(this).data('unit');
      var category = $(this).data('category');
      var description = $(this).data('description');
      var nip = $(this).data('nip');
      var phone = $(this).data('phone');

      $('#enama').val(nama);
      $('#eunit').val(unit);
      $("#edescription_id").val(category).trigger('change');
      $('#edescription').val(description);
      $('#enip').val(nip);
      $('#ephone').val(phone);

      // Tambahkan ID di action
      $('#editForm').attr('action', '/'+id);
    })
  });
</script>


<script


</body>
</html>
