<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EksportirController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedagangBesarController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\PengepulController;

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
  Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
  Route::get('home/{id}/akun', [HomeController::class, 'akun'])->name('home.akun')->middleware('auth');
  Route::put('home/{id}/akun_update', [HomeController::class, 'akunUpdate'])->name('home.akun_update')->middleware('auth');

  // logout
  Route::post('login/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

  // petani
  Route::get('petani', [PetaniController::class, 'index'])->name('petani')->middleware('auth');
  Route::get('petani/create', [PetaniController::class, 'create'])->name('petani.create')->middleware('auth');
  Route::post('petani/store', [PetaniController::class, 'store'])->name('petani.store')->middleware('auth');
  Route::get('petani/{id}/edit', [PetaniController::class, 'edit'])->name('petani.edit')->middleware('auth');
  Route::put('petani/{id}/update', [PetaniController::class, 'update'])->name('petani.update')->middleware('auth');
  Route::get('petani/{id}/delete', [PetaniController::class, 'delete'])->name('petani.delete')->middleware('auth');

  // pengepul
  Route::get('pengepul', [PengepulController::class, 'index'])->name('pengepul')->middleware('auth');
  Route::get('pengepul/create', [PengepulController::class, 'create'])->name('pengepul.create')->middleware('auth');
  Route::post('pengepul/store', [PengepulController::class, 'store'])->name('pengepul.store')->middleware('auth');
  Route::get('pengepul/{id}/edit', [PengepulController::class, 'edit'])->name('pengepul.edit')->middleware('auth');
  Route::put('pengepul/{id}/update', [PengepulController::class, 'update'])->name('pengepul.update')->middleware('auth');
  Route::get('pengepul/{id}/delete', [PengepulController::class, 'delete'])->name('pengepul.delete')->middleware('auth');

  // pedagang_besar
  Route::get('pedagang_besar', [PedagangBesarController::class, 'index'])->name('pedagang_besar')->middleware('auth');
  Route::get('pedagang_besar/create', [PedagangBesarController::class, 'create'])->name('pedagang_besar.create')->middleware('auth');
  Route::post('pedagang_besar/store', [PedagangBesarController::class, 'store'])->name('pedagang_besar.store')->middleware('auth');
  Route::get('pedagang_besar/{id}/edit', [PedagangBesarController::class, 'edit'])->name('pedagang_besar.edit')->middleware('auth');
  Route::put('pedagang_besar/{id}/update', [PedagangBesarController::class, 'update'])->name('pedagang_besar.update')->middleware('auth');
  Route::get('pedagang_besar/{id}/delete', [PedagangBesarController::class, 'delete'])->name('pedagang_besar.delete')->middleware('auth');

  // eksportir
  Route::get('eksportir', [EksportirController::class, 'index'])->name('eksportir')->middleware('auth');
  Route::get('eksportir/create', [EksportirController::class, 'create'])->name('eksportir.create')->middleware('auth');
  Route::post('eksportir/store', [EksportirController::class, 'store'])->name('eksportir.store')->middleware('auth');
  Route::get('eksportir/{id}/edit', [EksportirController::class, 'edit'])->name('eksportir.edit')->middleware('auth');
  Route::put('eksportir/{id}/update', [EksportirController::class, 'update'])->name('eksportir.update')->middleware('auth');
  Route::get('eksportir/{id}/delete', [EksportirController::class, 'delete'])->name('eksportir.delete')->middleware('auth');
});
