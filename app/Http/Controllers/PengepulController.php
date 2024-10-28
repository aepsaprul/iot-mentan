<?php

namespace App\Http\Controllers;

use App\Models\ModelHasPermission;
use App\Models\Pengepul;
use App\Models\RegDistrict;
use App\Models\RegProvince;
use App\Models\RegRegency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PengepulController extends Controller
{
  public function index()
  {
    $pengepuls = Pengepul::get();

    return view('pengepul.index', ['pengepuls' => $pengepuls]);
  }

  public function create()
  {
    $provinsi = RegProvince::get();
    
    return view('pengepul.create', ['provinsis' => $provinsi]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'telepon' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required',
      'alamat' => 'required',
      'provinsi_id' => 'required',
      'kabupaten_id' => 'required',
      'kecamatan_id' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.',
      'telepon.required' => 'Telepon harus diisi.',
      'email.required' => 'Email harus diisi.',
      'email.unique' => 'Email sudah digunakan.',
      'password.required' => 'Password harus diisi',
      'alamat.required' => 'Alamat harus diisi.',
      'provinsi_id.required' => 'Provinsi harus diisi.',
      'kabupaten_id.required' => 'Kabupaten harus diisi',
      'kecamatan_id.required' => 'Kecamatan harus diisi'
    ]);

    $user = new User;
    $user->name = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    $user->assignRole('pengepul');

    $pengguna = new Pengepul;
    $pengguna->user_id = $user->id;
    $pengguna->nama = $request->nama;
    $pengguna->telepon = $request->telepon;
    $pengguna->email = $request->email;
    $pengguna->alamat = $request->alamat;
    $pengguna->provinsi_id = $request->provinsi_id;
    $pengguna->kabupaten_id = $request->kabupaten_id;
    $pengguna->kecamatan_id = $request->kecamatan_id;
    $pengguna->save();

    return redirect()->route('pengepul')->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $pengepul = Pengepul::find($id);
    $provinsi = RegProvince::get();
    $kabupaten = RegRegency::get();
    $kecamatan = RegDistrict::get();
    
    return view('pengepul.edit', [
      'pengepul' => $pengepul,
      'provinsis' => $provinsi,
      'kabupatens' => $kabupaten,
      'kecamatans' => $kecamatan
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'telepon' => 'required',
      'alamat' => 'required',
      'provinsi_id' => 'required',
      'kabupaten_id' => 'required',
      'kecamatan_id' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.',
      'telepon.required' => 'Telepon harus diisi.',
      'alamat.required' => 'Alamat harus diisi.',
      'provinsi_id.required' => 'Provinsi harus diisi.',
      'kabupaten_id.required' => 'Kabupaten harus diisi',
      'kecamatan_id.required' => 'Kecamatan harus diisi'
    ]);

    $pengguna = new Pengepul;
    $pengguna->nama = $request->nama;
    $pengguna->telepon = $request->telepon;
    $pengguna->alamat = $request->alamat;
    $pengguna->provinsi_id = $request->provinsi_id;
    $pengguna->kabupaten_id = $request->kabupaten_id;
    $pengguna->kecamatan_id = $request->kecamatan_id;
    $pengguna->save();

    return redirect()->route('pengepul')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $pengepul = Pengepul::find($id);

    $user = User::find($pengepul->user_id);
    if ($user) {
      $user->roles()->detach();
      $user->permissions()->detach();
      $user->delete();
    }

    $pengepul->delete();

    return redirect()->route('pengepul')->with('message', 'Data berhasil dihapus');
  }

  public function akun($id)
  {
    $pengepul = Pengepul::find($id);

    return view('pengepul.akun', ['pengepul' => $pengepul]);
  }

  public function akunUpdate(Request $request, $id)
  {
    $pengepul = Pengepul::find($id);
    $pengepul->email = $request->email;
    $pengepul->save();

    $user = User::find($pengepul->user_id);
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    return redirect()->route('pengepul')->with('message', 'Data berhasil diperbaharui'); 
  }

  public function permission($id)
  {
    $pengepul = Pengepul::find($id);
    $model_has_permissions = ModelHasPermission::get();
    $permissions = Permission::get();

    return view('pengepul.permission', [
      'pengepul' => $pengepul,
      'model_has_permissions' => $model_has_permissions,
      'permissions' => $permissions
    ]);
  }

  public function permissionUpdate(Request $request)
  {
    $req_user_id = $request->user_id;
    $req_permission = $request->input('permission');

    if ($request->btn_submit == "btn_hapus") {
      $user = User::find($req_user_id);
      
      foreach ($req_permission as $key => $value) {
        $user->revokePermissionTo($value);
      }
    } else {  
      $model_has_permission = ModelHasPermission::where('model_id', $req_user_id);
      if ($model_has_permission) {
        $model_has_permission->delete();
      }
  
      $user = User::find($req_user_id);
      
      foreach ($req_permission as $key => $value) {
        $user->givePermissionTo($value);
      }
    }

    return redirect()->route('pengepul')->with('message', 'Permission berhasil diperbaharui.');
  }
}
