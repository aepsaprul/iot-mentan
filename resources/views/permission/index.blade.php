@extends('layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Permission</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Permission</li>
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
              <div class="d-flex justify-content-between">
                <div>
                  <h3>Role</h3>
                </div>
                <div>
                  <a href="{{ route('permission.role.create') }}" class="btn btn-sm btn-primary" style="width: 130px;"><i class="fas fa-plus"></i> Tambah</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if (session('message_role'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-check"></i> {{ session('message_role') }}
                </div>
              @endif
              <table id="tabel_role" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $key => $role)
                    <tr>
                      <td class="p-1">{{ $role->name }}</td>
                      <td class="text-center p-1">
                        <div class="btn-group">
                          <i class="fas fa-cog dropdown-toggle text-primary" data-toggle="dropdown"></i>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route('permission.role.edit', [$role->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt" style="width: 25px;"></i> Ubah</a></li>
                            <li><a href="{{ route('permission.role.has_permission', [$role->id]) }}" class="dropdown-item"><i class="fas fa-key" style="width: 25px;"></i> Permission</a></li>
                            <li><a href="{{ route('permission.role.delete', [$role->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')"><i class="fas fa-trash-alt" style="width: 25px;"></i> Hapus</a></li>
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

      {{-- permission --}}
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <div>
                  <h3>Permission</h3>
                </div>
                <div>
                  <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary" style="width: 130px;"><i class="fas fa-plus"></i> Tambah</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if (session('message_permission'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="icon fas fa-check"></i> {{ session('message_permission') }}
                </div>
              @endif
              
              <table id="tabel_permission" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="text-center">Menu</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($permissions as $key => $permission)
                    <tr>
                      <td class="p-1">{{ $permission->menu }}</td>
                      <td class="p-1">{{ $permission->name }}</td>
                      <td class="text-center p-1">
                        <div class="btn-group">
                          <i class="fas fa-cog dropdown-toggle text-primary" data-toggle="dropdown"></i>
                          <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ route('permission.edit', [$permission->id]) }}" class="dropdown-item"><i class="fas fa-pencil-alt" style="width: 25px;"></i> Ubah</a></li>
                            <li><a href="{{ route('permission.delete', [$permission->id]) }}" class="dropdown-item" onclick="return confirm('Yakin akan dihapus?')"><i class="fas fa-trash-alt" style="width: 25px;"></i> Hapus</a></li>
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
    $('#tabel_role').DataTable({
      "ordering": true,
      "responsive": true,
    });

    $('#tabel_permission').DataTable({
      "ordering": true,
      "responsive": true,
    });
  })
</script>
@endsection