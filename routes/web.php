<?php

use App\Http\Controllers\EksportirController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedagangBesarController;
use App\Http\Controllers\PengepulController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('login.auth');

Route::get('register', [LoginController::class, 'register'])->name('register');
Route::get('register/{id}/get_kabupaten', [LoginController::class, 'getKabupaten'])->name('register.get.kabupaten');
Route::get('register/{id}/get_kecamatan', [LoginController::class, 'getKecamatan'])->name('register.get.kecamatan');
Route::post('register/store', [LoginController::class, 'registerStore'])->name('register.store');

Route::middleware(['auth'])->group(function () {
  // home
  Route::get('home', [HomeController::class, 'index'])->name('home');
  Route::get('home/{id}/akun', [HomeController::class, 'akun'])->name('home.akun');
  Route::put('home/{id}/akun_update', [HomeController::class, 'akunUpdate'])->name('home.akun_update');

  // logout
  Route::post('login/logout', [LoginController::class, 'logout'])->name('logout');

  // petani
  Route::get('pengguna/petani', [PetaniController::class, 'index'])->name('petani');
  Route::get('pengguna/petani/create', [PetaniController::class, 'create'])->name('petani.create');
  Route::post('pengguna/petani/store', [PetaniController::class, 'store'])->name('petani.store');
  Route::get('pengguna/petani/{id}/edit', [PetaniController::class, 'edit'])->name('petani.edit');
  Route::put('pengguna/petani/{id}/update', [PetaniController::class, 'update'])->name('petani.update');
  Route::get('pengguna/petani/{id}/delete', [PetaniController::class, 'delete'])->name('petani.delete');

  // pengepul
  Route::get('pengguna/pengepul', [PengepulController::class, 'index'])->name('pengepul');
  Route::get('pengguna/pengepul/create', [PengepulController::class, 'create'])->name('pengepul.create');
  Route::post('pengguna/pengepul/store', [PengepulController::class, 'store'])->name('pengepul.store');
  Route::get('pengguna/pengepul/{id}/edit', [PengepulController::class, 'edit'])->name('pengepul.edit');
  Route::put('pengguna/pengepul/{id}/update', [PengepulController::class, 'update'])->name('pengepul.update');
  Route::get('pengguna/pengepul/{id}/delete', [PengepulController::class, 'delete'])->name('pengepul.delete');

  // pedagang_besar
  Route::get('pengguna/pedagang_besar', [PedagangBesarController::class, 'index'])->name('pedagang_besar');
  Route::get('pengguna/pedagang_besar/create', [PedagangBesarController::class, 'create'])->name('pedagang_besar.create');
  Route::post('pengguna/pedagang_besar/store', [PedagangBesarController::class, 'store'])->name('pedagang_besar.store');
  Route::get('pengguna/pedagang_besar/{id}/edit', [PedagangBesarController::class, 'edit'])->name('pedagang_besar.edit');
  Route::put('pengguna/pedagang_besar/{id}/update', [PedagangBesarController::class, 'update'])->name('pedagang_besar.update');
  Route::get('pengguna/pedagang_besar/{id}/delete', [PedagangBesarController::class, 'delete'])->name('pedagang_besar.delete');

  // eksportir
  Route::get('pengguna/eksportir', [EksportirController::class, 'index'])->name('eksportir');
  Route::get('pengguna/eksportir/create', [EksportirController::class, 'create'])->name('eksportir.create');
  Route::post('pengguna/eksportir/store', [EksportirController::class, 'store'])->name('eksportir.store');
  Route::get('pengguna/eksportir/{id}/edit', [EksportirController::class, 'edit'])->name('eksportir.edit');
  Route::put('pengguna/eksportir/{id}/update', [EksportirController::class, 'update'])->name('eksportir.update');
  Route::get('pengguna/eksportir/{id}/delete', [EksportirController::class, 'delete'])->name('eksportir.delete');

  // transaksi petani
  Route::get('transaksi/petani', [TransaksiController::class, 'petani'])->name('transaksi.petani');
  Route::get('transaksi/petani/create', [TransaksiController::class, 'petaniCreate'])->name('transaksi.petani.create');
  Route::post('transaksi/petani/store', [TransaksiController::class, 'petaniStore'])->name('transaksi.petani.store');

  // transaksi pengepul
  Route::get('transaksi/pengepul', [TransaksiController::class, 'pengepul'])->name('transaksi.pengepul');
  Route::get('transaksi/pengepul/create', [TransaksiController::class, 'pengepulCreate'])->name('transaksi.pengepul.create');
  Route::post('transaksi/pengepul/store', [TransaksiController::class, 'pengepulStore'])->name('transaksi.pengepul.store');
});
