@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Akun Pengepul</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengepul') }}">Pengepul</a></li>
            <li class="breadcrumb-item active">Akun</li>
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
              <form action="{{ route('pengepul.akun_update', [$pengepul->id]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="form-group row">
                  <label for="nama" class="col-sm-3 col-form-label">Nama Pengepul</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $pengepul->nama }}" placeholder="Nama Pengepul" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $pengepul->dataUser ? $pengepul->dataUser->email : '' }}" placeholder="Email" autofocus>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="password" id="password" value="{{ $pengepul->dataUser ? $pengepul->dataUser->password_show : '' }}" placeholder="Password">
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection