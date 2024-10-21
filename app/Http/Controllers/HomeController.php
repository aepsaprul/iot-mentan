<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Eksportir;
use App\Models\PedagangBesar;
use App\Models\Pengepul;
use App\Models\Petani;
use App\Models\User;

class HomeController extends Controller
{
  public function index()
  {
    return view('home');
  }

  public function akun($id)
  {
    $user = User::find(Auth::user()->id);

    return view('ubahPassword', ['user' => $user]);
  }

  public function akunUpdate(Request $request, $id)
  {
    $request->validate([
      'email' => 'required|email|unique:users'
    ], [
      'email.unique' => 'Email sudah digunakan.'
    ]);

    $user = User::find($id);

    if (Auth::user()->level == "petani") {
      $pengguna = Petani::where('email', $user->email)->first();
    } elseif (Auth::user()->level == "pengepul") {
      $pengguna = Pengepul::where('email', $user->email)->first();
    } elseif (Auth::user()->level == "pedagang_besar") {
      $pengguna = PedagangBesar::where('email', $user->email)->first();
    } else {
      $pengguna = Eksportir::where('email', $user->email)->first();
    }
    
    $pengguna->email = $request->email;
    $pengguna->save();

    
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    return redirect()->route('home')->with('message', 'Data berhasil diperbaharui'); 
  }
}
