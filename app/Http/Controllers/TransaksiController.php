<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Transaksi;
use App\Models\TransaksiEksportir;
use App\Models\TransaksiPedagang;
use App\Models\TransaksiPengepul;
use App\Models\TransaksiPetani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
  public function petani()
  {
    if (auth()->user()->hasRole('adm')) {
      $petanis = Transaksi::where('level', 'petani')->orderBy('id', 'desc')->limit(500)->get();
    } else {
      $petanis = Transaksi::where('level', 'petani')->where('pengguna_id', Auth::user()->dataPengguna->id)->limit(500)->get();
    }

    return view('transaksi.petani', ['petanis' => $petanis]);
  }

  public function pengepul()
  {
    if (auth()->user()->hasRole('adm')) {
      $pengepuls = Transaksi::where('level', 'pengepul')->orderBy('id', 'desc')->limit(500)->get();
    } else {
      $pengepuls = Transaksi::where('level', 'pengepul')->where('pengguna_id', Auth::user()->dataPengguna->id)->limit(500)->get();
    }

    return view('transaksi.pengepul', ['pengepuls' => $pengepuls]);
  }

  public function pedagang()
  {
    if (auth()->user()->hasRole('adm')) {
      $pedagangs = Transaksi::where('level', 'pedagang')->orderBy('id', 'desc')->limit(500)->get();
    } else {
      $pedagangs = Transaksi::where('level', 'pedagang')->where('pengguna_id', Auth::user()->dataPengguna->id)->limit(500)->get();
    }

    return view('transaksi.pedagang', ['pedagangs' => $pedagangs]);
  }
  
  public function eksportir()
  {
    if (auth()->user()->hasRole('adm')) {
      $eksportirs = Transaksi::where('level', 'eksportir')->orderBy('id', 'desc')->limit(500)->get();
    } else {
      $eksportirs = Transaksi::where('level', 'eksportir')->where('pengguna_id', Auth::user()->dataPengguna->id)->limit(500)->get();
    }

    return view('transaksi.eksportir', ['eksportirs' => $eksportirs]);
  }

  public function create($level)
  {
    if (auth()->user()->hasRole('adm')) {
      if ($level == "petani") {
        $pengguna = Pengguna::where('level', 'petani')->get();
      } elseif ($level == "pengepul") {
        $pengguna = Pengguna::where('level', 'pengepul')->get();
      } elseif ($level == "pedagang") {
        $pengguna = Pengguna::where('level', 'pedagang')->get();
      } else {
        $pengguna = Pengguna::where('level', 'eksportir')->get();
      }
    } else {
      $pengguna = Pengguna::where('user_id', Auth::user()->id)->first();
    }

    if ($level == "pengepul") {
      $penjual = Pengguna::where('level', 'petani')->get();
    } elseif ($level == "pedagang") {
      $penjual = Pengguna::where('level', 'pengepul')->get();
    } elseif ($level == "eksportir") {
      $penjual = Pengguna::where('level', 'pedagang')->get();
    } else {
      $penjual = Pengguna::where('level', 'petani')->get();
    }

    return view('transaksi.create', [
      'pengguna' => $pengguna,
      'level' => $level,
      'penjual' => $penjual
    ]);
  }

  public function store(Request $request)
  {
    $level = $request->level;

    $transaksi = new Transaksi;
    $transaksi->level = $level;
    $transaksi->pengguna_id = $request->pengguna_id;
    $transaksi->ipfs_hash = "tes";
    $transaksi->metode_pengeringan = $request->metode_pengeringan;
    $transaksi->tanggal_mulai_pengeringan = $request->tanggal_mulai_pengeringan;
    $transaksi->tanggal_selesai_pengeringan = $request->tanggal_selesai_pengeringan;
    $transaksi->nama_pembeli = $request->nama_pembeli;
    $transaksi->alamat_pembeli = $request->alamat_pembeli;
    $transaksi->metode_pengiriman = $request->metode_pengiriman;
    $transaksi->tanggal_penjualan = $request->tanggal_penjualan;

    if ($level == "petani") {
      $transaksi->lokasi_kebun = $request->lokasi_kebun;
      $transaksi->jumlah_tegakan = $request->jumlah_tegakan;
      $transaksi->umur_tanaman = $request->umur_tanaman;
      $transaksi->varietas_tanaman = $request->varietas_tanaman;
      $transaksi->tanggal_panen = $request->tanggal_panen;
      $transaksi->jumlah_panen = $request->jumlah_panen;
      $transaksi->bobot_biji_pala_kering = $request->bobot_biji_pala_kering;
      $transaksi->bobot_fuli_kering = $request->bobot_fuli_kering;
      $transaksi->tempat_penyimpanan = $request->tempat_penyimpanan;
    }
    if ($level == "pengepul" || $level == "pedagang" || $level == "eksportir") {
      $transaksi->penjual_id = $request->penjual_id;
      $transaksi->jumlah_produk_berdasarkan_mutu = $request->jumlah_produk_berdasarkan_mutu;
      $transaksi->kadar_air_produk = $request->kadar_air_produk;
      $transaksi->perlakuan = $request->perlakuan;
      $transaksi->kadar_air = $request->kadar_air;
      $transaksi->kondisi_penyimpanan = $request->kondisi_penyimpanan;
      $transaksi->bahan_pengemas = $request->bahan_pengemas;
    }
    if ($level == "eksportir") {
      $transaksi->no_sertifikat_coa = $request->no_sertifikat_coa;
    }

    $transaksi->save();

    return redirect()->route('transaksi.'.$level)->with('message', 'Data berhasil ditambahkan');
  }
}
