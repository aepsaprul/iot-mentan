<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    ]);

    $email = $request->email;
    $password = $request->password;
    $remember = $request->remember;

    if (Auth::attempt(['email' => $email, 'password' => $password, ], $remember)) {
      $request->session()->regenerate();

      return redirect()->intended('home');
    }    

    return back()->withErrors([
      'gagal' => 'Email / Passwors salah'
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
    return view('auth.register');
  }

  public function registerStore(Request $request)
  {
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->level = "admin";
    $user->save();

    return redirect()->route('login');
  }
}
