@extends('layouts.app')
@section('title') Ubah Petani @endsection
@section('style')
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Petani</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
            <li class="breadcrumb-item active">Ubah</li>
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
              <form action="{{ route('petani.update', [$petani->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="nama" class="col-sm-2 col-form-label">Nama Petani</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $petani->nama }}" placeholder="Nama Petani">
                    @error('nama')
                      <span class="text-danger text-sm font-italic">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="button" id="btn_spinner" class="btn btn-primary d-none" style="width: 150px;"><div class="spinner-border spinner-border-sm text-white" role="status"></div><span class="ml-2">Loading...</span></button>
                    <button type="submit" id="btn_submit" class="btn btn-primary" style="width: 150px;"><i class="fas fa-save"></i> Perbaharui</button>
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
  })
</script>
@endsection