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
          <h3 class="m-0">Role Has Permission <span class="text-uppercase text-success font-weight-bold">{{ $role->name }}</span></h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('permission') }}">Role</a></li>
            <li class="breadcrumb-item active">Has Permission</li>
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
              <form action="{{ route('permission.role.has_permission.update') }}" method="POST">
                @csrf

                {{-- role name --}}
                <input type="hidden" name="role" id="role" value="{{ $role->name }}">
                <input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}">

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
                          @foreach ($role_has_permissions as $role_has_permission)
                            @if ($role_has_permission->dataPermission->name == $row->name && $role_has_permission->dataRole->name == $role->name)
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