@extends('layouts.app')
@section('title') Tambah Transaksi {{ $level }} @endsection
@section('style')
<!-- select2 -->
<link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset(env('APP_PUBLIC') . 'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Transaksi <span class="text-capitalize">{{ $level }}</span></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transaksi.'.$level) }}">Transaksi <span class="text-capitalize">{{ $level }}</span></a></li>
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
              <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  {{-- level --}}
                  <input type="hidden" name="level" id="level" value="{{ $level }}">

                  @if (auth()->user()->hasRole('adm'))
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="pengguna_id">Nama <span class="text-capitalize">{{ $level }}</span></label>
                      <select name="pengguna_id" id="pengguna_id" class="form-control select2_petani">
                        <option value="">Pilih <span class="text-capitalize">{{ $level }}</span></option>
                        @foreach ($pengguna as $pengguna)
                          <option value="{{ $pengguna->id }}">{{ $pengguna->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                  @else
                    {{-- pengguna id --}}
                    <input type="hidden" name="pengguna_id" id="pengguna_id" value="{{ $pengguna->id }}">

                    <div class="col-lg-4 col-12 mb-3">
                      <label>Nama {{ $level }}</label>
                      <input type="text" class="form-control" value="{{ $pengguna->nama }}" placeholder="Nama {{ $level }}" readonly>
                    </div>
                  @endif
                  @if ($level == "petani")
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="lokasi_kebun">Lokasi Kebun</label>
                      <input type="text" name="lokasi_kebun" id="lokasi_kebun" class="form-control" placeholder="Lokasi Kebun">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="jumlah_tegakan">Jumlah Tegakan Tanaman</label>
                      <input type="text" name="jumlah_tegakan" id="jumlah_tegakan" class="form-control" placeholder="Jumlah Tegakan Tanaman">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="umur_tanaman">Umur Tanaman per Bulan</label>
                      <input type="text" name="umur_tanaman" id="umur_tanaman" class="form-control" placeholder="Umur Tanaman">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="varietas_tanaman">Varietas Tanaman</label>
                      <input type="text" name="varietas_tanaman" id="varietas_tanaman" class="form-control" placeholder="Varietas Tanaman">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="tanggal_panen">Tanggal Panen</label>
                      <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="jumlah_panen">Jumlah Panen per Kg</label>
                      <input type="text" name="jumlah_panen" id="jumlah_panen" class="form-control" placeholder="Jumlah Panen">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="bobot_biji_pala_kering">Bobot Biji Pala Kering per Kg</label>
                      <input type="text" name="bobot_biji_pala_kering" id="bobot_biji_pala_kering" class="form-control" placeholder="Bobot Biji Pala Kering">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="bobo_fuli_kering">Bobot Fuli Kering per Kg</label>
                      <input type="text" name="bobot_fuli_kering" id="bobot_fuli_kering" class="form-control" placeholder="Bobot Fuli Kering">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="tempat_penyimpanan">Tempat Penyimpanan</label>
                      <input type="text" name="tempat_penyimpanan" id="tempat_penyimpanan" class="form-control" placeholder="Tempat Penyimpanan">
                    </div>
                  @endif
                  @if ($level == "pengepul" || $level == "pedagang" || $level == "eksportir")
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="penjual_id">Nama <span class="text-capitalize">Penjual</span></label>
                      <select name="penjual_id" id="penjual_id" class="form-control select2_petani">
                        <option value="">Pilih <span class="text-capitalize">Penjual</span></option>
                        @foreach ($penjual as $penjual)
                          <option value="{{ $penjual->id }}">{{ $penjual->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="tanggal_pembelian">Tanggal Pembelian</label>
                      <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" value="{{ date('Y-m-d') }}" placeholder="Tanggal Pembelian">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="jumlah_produk_berdasarkan_mutu">Jumlah Produk Berdasarkan Mutu</label>
                      <input type="text" name="jumlah_produk_berdasarkan_mutu" id="jumlah_produk_berdasarkan_mutu" class="form-control" placeholder="Jumlah Produk Berdasarkan Mutu">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="kadar_air_produk">Kadar Air Produk</label>
                      <input type="text" name="kadar_air_produk" id="kadar_air_produk" class="form-control" placeholder="Kadar Air Produk">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="perlakuan">Perlakuan</label>
                      <input type="text" name="perlakuan" id="perlakuan" class="form-control" placeholder="Perlakuan">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="kadar_air">Kadar Air</label>
                      <input type="text" name="kadar_air" id="kadar_air" class="form-control" placeholder="Kadar Air">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="kondisi_penyimpanan">Kondisi Penyimpanan</label>
                      <input type="text" name="kondisi_penyimpanan" id="kondisi_penyimpanan" class="form-control" placeholder="Kondisi Penyimpanan">
                    </div>
                  @endif
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="metode_pengeringan">Metode Pengeringan</label>
                    <input type="text" name="metode_pengeringan" id="metode_pengeringan" class="form-control" placeholder="Metode Pengeringan">
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="tanggal_mulai_pengeringan">Tanggal Mulai Pengeringan</label>
                    <input type="date" name="tanggal_mulai_pengeringan" id="tanggal_mulai_pengeringan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="tanggal_selesai_pengeringan">Tanggal Selesai Pengeringan</label>
                    <input type="date" name="tanggal_selesai_pengeringan" id="tanggal_selesai_pengeringan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="bahan_pengemas">Bahan Pengemas</label>
                    <input type="text" name="bahan_pengemas" id="bahan_pengemas" class="form-control" placeholder="Bahan Pengemas">
                  </div>
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="tanggal_penjualan">{{ $level == "eksportir" ? "Tanggal Ekspor" : "Tanggal Penjualan" }}</label>
                    <input type="date" name="tanggal_penjualan" id="tanggal_penjualan" class="form-control" value="{{ date('Y-m-d') }}">
                  </div>
                  @if ($level == "petani" || $level == "pengepul" || $level == "pedagang")
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="metode_pengiriman">Metode Pengiriman</label>
                      <input type="text" name="metode_pengiriman" id="metode_pengiriman" class="form-control" placeholder="Metode Pengiriman">
                    </div>
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="harga">Harga</label>
                      <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga">
                    </div>
                  @endif
                  @if ($level == "eksportir")
                    <div class="col-lg-4 col-12 mb-3">
                      <label for="no_sertifikat_coa">Nomor Sertifikat COA</label>
                      <input type="text" name="no_sertifikat_coa" id="no_sertifikat_coa" class="form-control" placeholder="Nomor Sertifikat COA">
                    </div>
                  @endif
                  <div class="col-lg-4 col-12 mb-3">
                    <label for="nama_pembeli">{{ $level == "eksportir" ? "Nama Importir" : "Nama Pembeli" }}</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" placeholder="Nama Pembeli">
                  </div>
                  <div class="col-lg-12 col-12 mb-3">
                    <label for="alamat_pembeli">{{ $level == "eksportir" ? "Alamat Importir" : "Alamat Pembeli" }}</label>
                    <input type="text" name="alamat_pembeli" id="alamat_pembeli" class="form-control" placeholder="Alamat Pembeli">
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 text-right">
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

    $('.select2_petani').select2({
      theme: 'bootstrap4'
    })
  })
</script>
@endsection