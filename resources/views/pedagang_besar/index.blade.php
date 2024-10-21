@extends('layouts.app')
@section('title') Pedagang Besar @endsection
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Pedagang Besar</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Pedagang Besar</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('pedagang_besar.create') }}" class="btn btn-sm btn-primary" style="width: 130px;"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
              @if (session('message'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-check"></i> {{ session('message') }}
                </div>
              @endif
              <table id="tabel_pedagang_besar" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pedagang_besars as $key => $pedagang_besar)
                    <tr>
                      <td class="text-center p-1">{{ $key + 1 }}</td>
                      <td class="p-1">{{ $pedagang_besar->nama }}</td>
                      <td class="text-center p-1">
                        <div class="btn-group">
                          <i class="fas fa-cog dropdown-toggle text-primary" data-toggle="dropdown"></i>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route('pedagang_besar.edit', [$pedagang_besar->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt" style="width: 25px;"></i> Ubah</a></li>
                            <li><a href="{{ route('pedagang_besar.delete', [$pedagang_besar->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')"><i class="fas fa-trash-alt" style="width: 25px;"></i> Hapus</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function() {
    $('#tabel_pedagang_besar').DataTable({
      "responsive": true,
      "theme": 'bootstrap4'
    });
  })
</script>
@endsection