<?php

use App\Http\Controllers\EksportirController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedagangBesarController;
use App\Http\Controllers\PengepulController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PermissionController;
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

  // pengguna
  Route::get('pengguna/petani', [PenggunaController::class, 'petani'])->name('petani')->middleware('verified', 'permission:petani');
  Route::get('pengguna/pengepul', [PenggunaController::class, 'pengepul'])->name('pengepul')->middleware('verified', 'permission:pengepul');
  Route::get('pengguna/pedagang', [PenggunaController::class, 'pedagang'])->name('pedagang')->middleware('verified', 'permission:pedagang');
  Route::get('pengguna/eksportir', [PenggunaController::class, 'eksportir'])->name('eksportir')->middleware('verified', 'permission:eksportir');
  Route::get('pengguna/{level}/create', [PenggunaController::class, 'create'])->name('pengguna.create')->middleware('verified', 'permission:pengguna-tambah');
  Route::post('pengguna/store', [PenggunaController::class, 'store'])->name('pengguna.store');
  Route::get('pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit')->middleware('verified', 'permission:pengguna-ubah');
  Route::put('pengguna/{id}/update', [PenggunaController::class, 'update'])->name('pengguna.update');
  Route::get('pengguna/{id}/delete', [PenggunaController::class, 'delete'])->name('pengguna.delete');
  Route::get('pengguna/{id}/akun', [PenggunaController::class, 'akun'])->name('pengguna.akun')->middleware(['permission:pengguna-akun']);
  Route::put('pengguna/{id}/akun_update', [PenggunaController::class, 'akunUpdate'])->name('pengguna.akun_update');
  Route::get('pengguna/{id}/permission', [PenggunaController::class, 'permission'])->name('pengguna.permission')->middleware(['permission:pengguna-permission']);
  Route::post('pengguna/permission/update', [PenggunaController::class, 'permissionUpdate'])->name('pengguna.permission.update');

  // pengepul
  // Route::get('pengguna/pengepul', [PengepulController::class, 'index'])->name('pengepul')->middleware('verified', 'permission:pengepul');
  // Route::get('pengguna/pengepul/create', [PengepulController::class, 'create'])->name('pengepul.create')->middleware('verified', 'permission:pengepul-tambah');
  // Route::post('pengguna/pengepul/store', [PengepulController::class, 'store'])->name('pengepul.store');
  // Route::get('pengguna/pengepul/{id}/edit', [PengepulController::class, 'edit'])->name('pengepul.edit')->middleware('verified', 'permission:pengepul-ubah');
  // Route::put('pengguna/pengepul/{id}/update', [PengepulController::class, 'update'])->name('pengepul.update');
  // Route::get('pengguna/pengepul/{id}/delete', [PengepulController::class, 'delete'])->name('pengepul.delete');
  // Route::get('pengguna/pengepul/{id}/akun', [PengepulController::class, 'akun'])->name('pengepul.akun')->middleware(['permission:pengepul-akun']);
  // Route::put('pengguna/pengepul/{id}/akun_update', [PengepulController::class, 'akunUpdate'])->name('pengepul.akun_update');
  // Route::get('pengguna/pengepul/{id}/permission', [PengepulController::class, 'permission'])->name('pengepul.permission')->middleware(['permission:pengepul-permission']);
  // Route::post('pengguna/pengepul/permission/update', [PengepulController::class, 'permissionUpdate'])->name('pengepul.permission.update');

  // pedagang_besar
  // Route::get('pengguna/pedagang_besar', [PedagangBesarController::class, 'index'])->name('pedagang_besar')->middleware('verified', 'permission:pedagang');
  // Route::get('pengguna/pedagang_besar/create', [PedagangBesarController::class, 'create'])->name('pedagang_besar.create')->middleware('verified', 'permission:pedagang-tambah');
  // Route::post('pengguna/pedagang_besar/store', [PedagangBesarController::class, 'store'])->name('pedagang_besar.store');
  // Route::get('pengguna/pedagang_besar/{id}/edit', [PedagangBesarController::class, 'edit'])->name('pedagang_besar.edit')->middleware('verified', 'permission:pedagang-ubah');
  // Route::put('pengguna/pedagang_besar/{id}/update', [PedagangBesarController::class, 'update'])->name('pedagang_besar.update');
  // Route::get('pengguna/pedagang_besar/{id}/delete', [PedagangBesarController::class, 'delete'])->name('pedagang_besar.delete');

  // eksportir
  // Route::get('pengguna/eksportir', [EksportirController::class, 'index'])->name('eksportir')->middleware('verified', 'permission:eksportir');
  // Route::get('pengguna/eksportir/create', [EksportirController::class, 'create'])->name('eksportir.create')->middleware('verified', 'permission:eksportir-tambah');
  // Route::post('pengguna/eksportir/store', [EksportirController::class, 'store'])->name('eksportir.store');
  // Route::get('pengguna/eksportir/{id}/edit', [EksportirController::class, 'edit'])->name('eksportir.edit')->middleware('verified', 'permission:eksportir-ubah');
  // Route::put('pengguna/eksportir/{id}/update', [EksportirController::class, 'update'])->name('eksportir.update');
  // Route::get('pengguna/eksportir/{id}/delete', [EksportirController::class, 'delete'])->name('eksportir.delete');

  // transaksi petani
  Route::get('transaksi/petani', [TransaksiController::class, 'petani'])->name('transaksi.petani')->middleware('verified', 'permission:transaksi-petani');
  Route::get('transaksi/petani/create', [TransaksiController::class, 'petaniCreate'])->name('transaksi.petani.create')->middleware('verified', 'permission:transaksi-petani-create');
  Route::post('transaksi/petani/store', [TransaksiController::class, 'petaniStore'])->name('transaksi.petani.store');
  Route::get('transaksi/petani/delete', [TransaksiController::class, 'petaniDelete'])->name('transaksi.petani.delete');

  // transaksi pengepul
  Route::get('transaksi/pengepul', [TransaksiController::class, 'pengepul'])->name('transaksi.pengepul')->middleware('verified', 'permission:transaksi-pengepul');
  Route::get('transaksi/pengepul/create', [TransaksiController::class, 'pengepulCreate'])->name('transaksi.pengepul.create')->middleware('verified', 'permission:transaksi-pengepul-create');
  Route::post('transaksi/pengepul/store', [TransaksiController::class, 'pengepulStore'])->name('transaksi.pengepul.store');
  Route::get('transaksi/pengepul/delete', [TransaksiController::class, 'pengepulDelete'])->name('transaksi.pengepul.delete');

  // permission
  Route::get('adm/permission', [PermissionController::class, 'index'])->name('permission')->middleware('role:adm');
  Route::get('adm/permission/create', [PermissionController::class, 'create'])->name('permission.create')->middleware('role:adm');
  Route::post('adm/permission/store', [PermissionController::class, 'store'])->name('permission.store')->middleware('role:adm');
  Route::get('adm/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('role:adm');
  Route::put('adm/permission/{id}/update', [PermissionController::class, 'update'])->name('permission.update')->middleware('role:adm');
  Route::get('adm/permission/{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete')->middleware('role:adm');
  Route::get('adm/permission/role', [PermissionController::class, 'role'])->name('permission.role')->middleware('role:adm');
  Route::get('adm/permission/role/create', [PermissionController::class, 'roleCreate'])->name('permission.role.create')->middleware('role:adm');
  Route::post('adm/permission/role/store', [PermissionController::class, 'roleStore'])->name('permission.role.store')->middleware('role:adm');
  Route::get('adm/permission/role/{id}/edit', [PermissionController::class, 'roleEdit'])->name('permission.role.edit')->middleware('role:adm');
  Route::put('adm/permission/role/{id}/update', [PermissionController::class, 'roleUpdate'])->name('permission.role.update')->middleware('role:adm');
  Route::get('adm/permission/role/{id}/has_permission', [PermissionController::class, 'roleHasPermission'])->name('permission.role.has_permission')->middleware('role:adm');
  Route::post('adm/permission/role/has_permission_update', [PermissionController::class, 'roleHasPermissionUpdate'])->name('permission.role.has_permission.update')->middleware('role:adm');
  Route::get('adm/permission/role/{id}/delete', [PermissionController::class, 'roleDelete'])->name('permission.role.delete')->middleware('role:adm');
});
