<?php

namespace App\Http\Controllers;

use App\Models\Pengepul;
use App\Models\Petani;
use App\Models\TransaksiPengepul;
use App\Models\TransaksiPetani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
  public function petani()
  {
    $petanis = TransaksiPetani::orderBy('id', 'desc')->limit(500)->get();

    return view('transaksi.petani.index', ['petanis' => $petanis]);
  }

  public function petaniCreate()
  {
    return view('transaksi.petani.create');
  }

  public function petaniStore(Request $request)
  {
    $petani = new TransaksiPetani;
    $petani->petani_id = $request->petani_id;
    $petani->lokasi_kebun = $request->lokasi_kebun;
    $petani->jumlah_tegakan = $request->jumlah_tegakan;
    $petani->umur_tanaman = $request->umur_tanaman;
    $petani->varietas_tanaman = $request->varietas_tanaman;
    $petani->tanggal_panen = $request->tanggal_panen;
    $petani->jumlah_panen = $request->jumlah_panen;
    $petani->metode_pengeringan = $request->metode_pengeringan;
    $petani->tanggal_mulai_pengeringan = $request->tanggal_mulai_pengeringan;
    $petani->tanggal_selesai_pengeringan = $request->tanggal_selesai_pengeringan;
    $petani->bobot_biji_pala_kering = $request->bobot_biji_pala_kering;
    $petani->bobot_fuli_kering = $request->bobot_fuli_kering;
    $petani->bahan_pengemas = $request->bahan_pengemas;
    $petani->tempat_penyimpanan = $request->tempat_penyimpanan;
    $petani->tanggal_penjualan = $request->tanggal_penjualan;
    $petani->metode_pengiriman = $request->metode_pengiriman;
    $petani->harga = $request->harga;
    $petani->nama_pembeli = $request->nama_pembeli;
    $petani->alamat_pembeli = $request->alamat_pembeli;
    $petani->ipfs_hash = "tes";
    $petani->save();

    return redirect()->route('transaksi.petani')->with('message', 'Data berhasil ditambahkan');
  }

  public function pengepul()
  {
    $pengepuls = TransaksiPengepul::orderBy('id', 'desc')->limit(500)->get();

    return view('transaksi.pengepul.index', ['pengepuls' => $pengepuls]);
  }

  public function pengepulCreate()
  {
    if (auth()->user()->hasRole('adm')) {
      $pengepul = Pengepul::get();
    } else {
      $pengepul = Pengepul::where('email', Auth::user()->email)->first();
    }
    dd($pengepul);
    $petanis = Petani::get();

    return view('transaksi.pengepul.create', ['petanis' => $petanis]);
  }

  public function pengepulStore(Request $request)
  {
    $pengepul = new TransaksiPengepul;
    $pengepul->pengepul_id = $request->pengepul_id;
    $pengepul->tanggal_pembelian = $request->tanggal_pembelian;
    $pengepul->petani_id = $request->petani_id;
    $pengepul->jumlah_produk_berdasarkan_mutu = $request->jumlah_produk_berdasarkan_mutu;
    $pengepul->kadar_air_produk = $request->kadar_air_produk;
    $pengepul->perlakuan = $request->perlakuan;
    $pengepul->metode_pengeringan = $request->metode_pengeringan;
    $pengepul->tanggal_mulai_pengeringan = $request->tanggal_mulai_pengeringan;
    $pengepul->tanggal_selesai_pengeringan = $request->tanggal_selesai_pengeringan;
    $pengepul->kadar_air = $request->kadar_air;
    $pengepul->kondisi_penyimpanan = $request->kondisi_penyimpanan;
    $pengepul->bahan_pengemas = $request->bahan_pengemas;
    $pengepul->tanggal_penjualan = $request->tanggal_penjualan;
    $pengepul->metode_pengiriman = $request->metode_pengiriman;
    $pengepul->harga = $request->harga;
    $pengepul->nama_pembeli = $request->nama_pembeli;
    $pengepul->alamat_pembeli = $request->alamat_pembeli;
    $pengepul->ipfs_hash = "tes";
    $pengepul->save();

    return redirect()->route('transaksi.pengepul')->with('message', 'Data berhasil ditambahkan');
  }
}
