@extends('layouts.app')
@section('title') Tambah {{ $level }} @endsection
@section('style')
<!-- select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah {{ $level }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route($level) }}">{{ $level }}</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="level">Level</label>
                    <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="petani" placeholder="Level" required readonly>
                    @error('level')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Lengkap" required autofocus>
                    @error('nama')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="telepon">Telepon / WhatsApp</label>
                    <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon') }}" placeholder="Telepon / WhatsApp" required>
                    @error('telepon')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12 mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
                    @error('alamat')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="provinsi_id">Provinsi</label>
                    <select name="provinsi_id" id="provinsi_id" class="form-control select2_regency" >
                      <option value="">Pilih Provinsi</option>
                      @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                      @endforeach
                    </select>
                    @error('provinsi_id')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="kabupaten_id">Kabupaten/Kota</label>
                    <select name="kabupaten_id" id="kabupaten_id" class="form-control" >
                      <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    @error('kabupaten_id')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="kecamatan_id">Kecamatan</label>
                    <select name="kecamatan_id" id="kecamatan_id" class="form-control" >
                      <option value="">Pilih Kecamatan</option>
                    </select>
                    @error('kecamatan_id')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-3 col-12 mb-3">
                    <label for="luas_lahan">Luas Lahan</label>
                    <input type="text" name="luas_lahan" id="luas_lahan" class="form-control @error('luas_lahan') is-invalid @enderror" value="{{ old('luas_lahan') }}" placeholder="Luas Lahan" required>
                    @error('luas_lahan')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-3 col-12 mb-3">
                    <label for="komoditas">Komoditas</label>
                    <input type="text" name="komoditas" id="komoditas" class="form-control @error('komoditas') is-invalid @enderror" value="{{ old('komoditas') }}" placeholder="Komoditas" required>
                    @error('komoditas')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-3 col-12 mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-lg-3 col-12 mb-3">
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Password" required>
                    @error('password')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="button" id="btn_spinner" class="btn btn-primary d-none" style="width: 150px;"><div class="spinner-border spinner-border-sm text-white" role="status"></div><span class="ml-2">Loading...</span></button>
                    <button type="submit" id="btn_submit" class="btn btn-primary" style="width: 150px;"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset(env('APP_PUBLIC') . 'plugins/select2/js/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function() {
    // btn loading
    $('#btn_submit').on('click', function() {
      $('#btn_spinner').removeClass('d-none');
      $('#btn_submit').addClass('d-none');
      setTimeout(() => {
        $('#btn_spinner').addClass('d-none');
        $('#btn_submit').removeClass('d-none');
      }, 5000);
    })

    $('.select2_regency').select2({
      theme: 'bootstrap4'
    })

    $('#provinsi_id').on('change', function() {
      let provinsiId = $(this).val();
      $('#kabupaten_id').html('<option value="">Pilih kabupaten</option>');

      let url = "{{ route('register.get.kabupaten', ':id') }}";
      url = url.replace(':id', provinsiId);

      if(provinsiId) {
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            let kabupatenSelect = $('#kabupaten_id');
            $.each(response.data, function(key, value) {
              kabupatenSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

            kabupatenSelect.select2({
              placeholder: "Pilih Kabupaten",
              allowClear: true,
              theme: 'bootstrap4'
            });
          }
        });
      }
    });

    $('#kabupaten_id').on('change', function() {
      let kabupatenId = $(this).val();
      $('#kecamatan_id').html('<option value="">Pilih Kecamatan</option>');

      let url = "{{ route('register.get.kecamatan', ':id') }}";
      url = url.replace(':id', kabupatenId);
      console.log(url);
      

      if(kabupatenId) {
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            let kecamatanSelect = $('#kecamatan_id');
            $.each(response.data, function(key, value) {
              kecamatanSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
            });

            kecamatanSelect.select2({
              placeholder: "Pilih Kecamatan",
              allowClear: true,
              theme: 'bootstrap4'
            });
          }
        });
      }
    });
  })
</script>
@endsection