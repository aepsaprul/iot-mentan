@extends('layouts.app')
@section('title') Tambah Transaksi Pengepul @endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Transaksi Pengepul</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transaksi.pengepul') }}">Transaksi Pengepul</a></li>
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
              <form action="{{ route('transaksi.pengepul.store') }}" method="POST">
                @csrf

                

                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="petani_id">Nama Petani</label>
                    <select name="petani_id" id="petani_id" class="form-control">
                      <option value="">Pilih Petani</option>
                      @foreach ($petanis as $petani)
                        <option value="{{ $petani->id }}">{{ $petani->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="jumlah_produk_berdasarkan_mutu">Jumlah Produk Berdasarkan Mutu</label>
                    <input type="text" name="jumlah_produk_berdasarkan_mutu" id="jumlah_produk_berdasarkan_mutu" class="form-control" placeholder="Jumlah Produk Berdasarkan Mutu">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="kadar_air_produk">Kadar Air Produk</label>
                    <input type="text" name="kadar_air_produk" id="kadar_air_produk" class="form-control" placeholder="Kadar_air_produk">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="perlakuan">Perlakuan</label>
                    <input type="text" name="perlakuan" id="perlakuan" class="form-control" placeholder="Perlakuan">
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
                    <label for="kadar_air">Kadar Air</label>
                    <input type="text" name="kadar_air" id="kadar_air" class="form-control" placeholder="Kadar Air">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="kondisi_penyimpanan">Kondisi Penyimpanan</label>
                    <input type="text" name="kondisi_penyimpanan" id="kondisi_penyimpanan" class="form-control" placeholder="Kondisi Penyimpanan">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="bahan_pengemas">Bahan Pengemas</label>
                    <input type="text" name="bahan_pengemas" id="bahan_pengemas" class="form-control" placeholder="Metode Pengiriman">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="tanggal_penjualan">Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-4 col-12">
                    <label for="metode_pengiriman">Metode Pengiriman</label>
                    <input type="text" name="metode_pengiriman" id="metode_pengiriman" class="form-control" placeholder="Metode Pengiriman">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga">
                  </div>
                  <div class="col-lg-4 col-12">
                    <label for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-lg-12 col-12">
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