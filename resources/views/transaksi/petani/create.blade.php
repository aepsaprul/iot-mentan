@extends('layouts.app')
@section('title') Tambah Transaksi Petani @endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Transaksi Petani</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transaksi.petani') }}">Transaksi Petani</a></li>
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
              <form action="{{ route('transaksi.petani.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="petani_id">Nama Petani</label>
                    <input type="text" name="petani_id" id="petani_id" class="form-control" placeholder="Nama Petani">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="alamat">Alamat Petani</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Petani">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="lokasi_kebun">Lokasi Kebun</label>
                    <input type="text" name="lokasi_kebun" id="lokasi_kebun" class="form-control" placeholder="Lokasi Kebun">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="jumlah_tegakan">Jumlah Tegakan Tanaman</label>
                    <input type="text" name="jumlah_tegakan" id="jumlah_tegakan" class="form-control" placeholder="Jumlah Tegakan Tanaman">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="umur_tanaman">Umur Tanaman per Bulan</label>
                    <input type="text" name="umur_tanaman" id="umur_tanaman" class="form-control" placeholder="Umur Tanaman">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="varietas_tanaman">Varietas Tanaman</label>
                    <input type="text" name="varietas_tanaman" id="varietas_tanaman" class="form-control" placeholder="Varietas Tanaman">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_panen">Tanggal Panen</label>
                    <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="jumlah_panen">Jumlah Panen per Kg</label>
                    <input type="text" name="jumlah_panen" id="jumlah_panen" class="form-control" placeholder="Jumlah Panen">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="metode_pengeringan">Metode Pengeringan</label>
                    <input type="text" name="metode_pengeringan" id="metode_pengeringan" class="form-control" placeholder="Metode Pengeringan">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_mulai_pengeringan">Tanggal Mulai Pengeringan</label>
                    <input type="date" name="tanggal_mulai_pengeringan" id="tanggal_mulai_pengeringan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_selesai_pengeringan">Tanggal Selesai Pengeringan</label>
                    <input type="date" name="tanggal_selesai_pengeringan" id="tanggal_selesai_pengeringan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="bahan_pengemas">Bahan Pengemas</label>
                    <input type="text" name="bahan_pengemas" id="bahan_pengemas" class="form-control" placeholder="Bahan Pengemas">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="bobot_biji_pala_kering">Bobot Biji Pala Kering per Kg</label>
                    <input type="text" name="bobot_biji_pala_kering" id="bobot_biji_pala_kering" class="form-control" placeholder="Bobot Biji Pala Kering">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="bobo_fuli_kering">Bobot Fuli Kering per Kg</label>
                    <input type="text" name="bobot_fuli_kering" id="bobot_fuli_kering" class="form-control" placeholder="Bobot Fuli Kering">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="tempat_penyimpanan">Tempat Penyimpanan</label>
                    <input type="text" name="tempat_penyimpanan" id="tempat_penyimpanan" class="form-control" placeholder="Tempat Penyimpanan">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_penjualan">Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="metode_pengiriman">Metode Pengiriman</label>
                    <input type="text" name="metode_pengiriman" id="metode_pengiriman" class="form-control" placeholder="Metode Pengiriman">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                  </div>
                  <div class="col-lg-8 col-12">
                    <label for="alamat_pembeli">Alamat Pembeli</label>
                    <input type="text" name="alamat_pembeli" id="alamat_pembeli" class="form-control" placeholder="Alamat Pembeli">
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