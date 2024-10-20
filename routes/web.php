<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetaniController;

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
Route::post('register/store', [LoginController::class, 'registerStore'])->name('register.store');

Route::middleware(['auth'])->group(function () {
  // home
  Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

  // logout
  Route::post('login/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

  // petani
  Route::get('petani', [PetaniController::class, 'index'])->name('petani')->middleware('auth');
  Route::get('petani/create', [PetaniController::class, 'create'])->name('petani.create')->middleware('auth');
  Route::post('petani/store', [PetaniController::class, 'store'])->name('petani.store')->middleware('auth');
  Route::get('petani/{id}/edit', [PetaniController::class, 'edit'])->name('petani.edit')->middleware('auth');
  Route::put('petani/{id}/update', [PetaniController::class, 'update'])->name('petani.update')->middleware('auth');
  Route::get('petani/{id}/delete', [PetaniController::class, 'delete'])->name('petani.delete')->middleware('auth');
});
