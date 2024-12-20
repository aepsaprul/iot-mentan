@extends('layouts.app')
@section('title') Ubah Role @endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Role</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permission') }}">Role</a></li>
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
              <form action="{{ route('permission.role.update', [$role->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">Nama Role *</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $role->name }}" placeholder="Nama Role" autofocus>
                    @error('name')
                      <div class="col">
                        <span class="text-danger font-italic">{{ $message }}</span>
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Perbaharui</button>
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