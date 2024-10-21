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
      'password' => 'required'
    ], [
      'password.required' => 'Password harus diisi.'
    ]);

    $user = User::find($id);
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    return redirect()->route('home')->with('message', 'Data berhasil diperbaharui'); 
  }
}
