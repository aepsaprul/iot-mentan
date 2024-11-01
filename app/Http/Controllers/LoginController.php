<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\RegDistrict;
use App\Models\RegProvince;
use App\Models\RegRegency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function index()
  {
    if (Auth::user()) {
      return redirect()->route('home');
    }
    return view('auth.login');
  }
  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ], [
      'email.required' => 'Email harus diisi.',
      'password.required' => 'Password harus diisi.'
    ]);

    $email = $request->email;
    $password = $request->password;
    $remember = $request->remember;

    if (Auth::attempt(['email' => $email, 'password' => $password, ], $remember)) {
      $request->session()->regenerate();

      return redirect()->intended('home');
    }    

    return back()->withErrors([
      'gagal' => 'Email / Password salah'
    ]);
  }
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function register()
  {
    $provinsi = RegProvince::get();

    return view('auth.register', [
      'provinsis' => $provinsi
    ]);
  }

  public function getKabupaten($id)
  {
    $kabupatens = RegRegency::where('province_id', $id)->get();

    return response()->json([
      'data' => $kabupatens
    ]);
  }

  public function getKecamatan($id)
  {
    $kecamatans = RegDistrict::where('regency_id', $id)->get();

    return response()->json([
      'data' => $kecamatans
    ]);
  }

  public function registerStore(Request $request)
  {
    $request->validate([
      'jenis_user' => 'required',
      'nama' => 'required',
      'telepon' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed',
      'alamat' => 'required',
      'provinsi_id' => 'required',
      'kabupaten_id' => 'required',
      'kecamatan_id' => 'required'
    ], [
      'jenis_user.required' => 'Jenis User harus diisi.',
      'nama.required' => 'Nama harus diisi.',
      'telepon.required' => 'Telepon harus diisi.',
      'email.required' => 'Email harus diisi.',
      'email.unique' => 'Email sudah digunakan.',
      'password.required' => 'Password harus diisi',
      'password.confirmed' => 'Password tidak cocok',
      'alamat.required' => 'Alamat harus diisi.',
      'provinsi_id.required' => 'Provinsi harus diisi.',
      'kabupaten_id.required' => 'Kabupaten harus diisi',
      'kecamatan_id.required' => 'Kecamatan harus diisi'
    ]);

    $jenis = $request->jenis_user;

    $user = new User;
    $user->name = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->level = $jenis;
    $user->save();

    $pengguna = new Pengguna;

    if ($jenis == "petani") {
      $user->assignRole('petani');
      $pengguna->level = "petani";
    } elseif ($jenis == "pengepul") {
      $user->assignRole('pengepul');
      $pengguna->level = "pengepul";
    } elseif ($jenis == "pedagang_besar") {
      $user->assignRole('pedagang');
      $pengguna->level = "pedagang";
    } else {
      $user->assignRole('pengepul');
      $pengguna->level = "eksportir";
    }
    
    $pengguna->user_id = $user->id;
    $pengguna->nama = $request->nama;
    $pengguna->telepon = $request->telepon;
    $pengguna->email = $request->email;
    $pengguna->alamat = $request->alamat;
    $pengguna->provinsi_id = $request->provinsi_id;
    $pengguna->kabupaten_id = $request->kabupaten_id;
    $pengguna->kecamatan_id = $request->kecamatan_id;
    $pengguna->ipfs_hash = "tes";
    $pengguna->save();    

    return redirect()->route('login');
  }
}
