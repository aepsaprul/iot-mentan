@extends('layouts.app')
@section('style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

<style>
  /* Untuk membuat ukuran checkbox lebih besar */
  input[type="checkbox"] {
      width: 20px;  /* Lebar checkbox */
      height: 20px; /* Tinggi checkbox */
  }

  /* Optional: untuk customisasi lebih lanjut */
  input[type="checkbox"]:checked {
      background-color: #4caf50; /* Warna background jika dicentang */
      border: 2px solid #4caf50; /* Border ketika dicentang */
  }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="m-0">Pengepul Permission <span class="text-uppercase text-success font-weight-bold">{{ $pengepul->nama }}</span></h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengepul') }}">Pengepul</a></li>
            <li class="breadcrumb-item active">Permission</li>
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
              <form action="{{ route('pengepul.permission.update') }}" method="POST">
                @csrf

                {{-- user id --}}
                <input type="hidden" name="user_id" id="user_id" value="{{ $pengepul->user_id }}">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">Menu</th>
                      <th class="text-center">Nama Permission</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      // Mengurutkan data berdasarkan sub dan button
                      $sortedNavigasi = $permissions->sortBy('menu')->sortBy('button');
                      
                      $lastSub = '';
                      $subRowspanCount = [];
                    @endphp

                    {{-- Hitung rowspan untuk setiap sub --}}
                    @foreach($sortedNavigasi as $row)
                      @if (!isset($subRowspanCount[$row->menu]))
                        @php
                          $subRowspanCount[$row->menu] = $sortedNavigasi->where('menu', $row->menu)->count();
                        @endphp
                      @endif
                    @endforeach

                    {{-- Tampilkan tabel --}}
                    @foreach($sortedNavigasi as $index => $row)
                      <tr>
                        {{-- Kolom Sub: tampilkan hanya jika berbeda dari sebelumnya --}}
                        @if ($row->menu != $lastSub)
                          <td rowspan="{{ $subRowspanCount[$row->menu] }}" class="text-capitalize">{{ $row->menu }}</td>
                          @php $lastSub = $row->menu; @endphp
                        @endif
                
                        {{-- Kolom Button: selalu tampil --}}
                        <td>{{ $row->name }}</td>
                        <td class="text-center">
                          <input type="checkbox" name="permission[]" id="permission{{ $row->id }}" value="{{ $row->name }}"
                          @foreach ($model_has_permissions as $model_has_permission)
                            @if ($model_has_permission->dataPermission->name == $row->name && $model_has_permission->dataUser->id == $pengepul->dataUser->id)
                              checked
                            @endif
                          @endforeach
                          >
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="row mt-3">
                  <div class="col-12 text-right">
                    <button type="submit" name="btn_submit" value="btn_hapus" class="btn btn-danger" style="width: 130px;"><i class="fas fa-trash-alt"></i> Hapus</button>
                    <button type="submit" name="btn_submit" value="btn_simpan" class="btn btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Simpan</button>
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