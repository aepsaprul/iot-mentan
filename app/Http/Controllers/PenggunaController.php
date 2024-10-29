<?php

namespace App\Http\Controllers;

use App\Models\ModelHasPermission;
use App\Models\Pengguna;
use App\Models\RegDistrict;
use App\Models\RegProvince;
use App\Models\RegRegency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class PenggunaController extends Controller
{
  public function petani()
  {
    $penggunas = Pengguna::where('level', 'petani')->orderBy('id', 'desc')->get();

    return view('pengguna.petani', ['penggunas' => $penggunas]);
  }

  public function pengepul()
  {
    $penggunas = Pengguna::where('level', 'pengepul')->orderBy('id', 'desc')->get();

    return view('pengguna.pengepul', ['penggunas' => $penggunas]);
  }

  public function pedagang()
  {
    $penggunas = Pengguna::where('level', 'pedagang')->orderBy('id', 'desc')->get();

    return view('pengguna.pedagang', ['penggunas' => $penggunas]);
  }

  public function eksportir()
  {
    $penggunas = Pengguna::where('level', 'eksportir')->orderBy('id', 'desc')->get();

    return view('pengguna.eksportir', ['penggunas' => $penggunas]);
  }

  public function create($level)
  {
    $provinsi = RegProvince::get();
    
    return view('pengguna.create', [
      'provinsis' => $provinsi,
      'level' => $level
    ]);
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

    $level = $request->level;

    $user = new User;
    $user->name = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    if ($level == "petani") {
      $user->assignRole('petani');
    } elseif ($level == "pengepul") {
      $user->assignRole('pengepul');
    } elseif ($level == "pedagang") {
      $user->assignRole('pedagang');
    } else {
      $user->assignRole('eksportir');
    }

    $pengguna = new Pengguna;
    $pengguna->user_id = $user->id;
    $pengguna->level = $level;
    $pengguna->nama = $request->nama;
    $pengguna->telepon = $request->telepon;
    $pengguna->email = $request->email;
    $pengguna->alamat = $request->alamat;
    $pengguna->provinsi_id = $request->provinsi_id;
    $pengguna->kabupaten_id = $request->kabupaten_id;
    $pengguna->kecamatan_id = $request->kecamatan_id;
    $pengguna->luas_lahan = $request->luas_lahan;
    $pengguna->komoditas = $request->komoditas;
    $pengguna->ipfs_hash = "tes";
    $pengguna->save();

    return redirect()->route($level)->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $pengguna = Pengguna::find($id);
    $level = $pengguna->level;
    $provinsi = RegProvince::get();
    $kabupaten = RegRegency::get();
    $kecamatan = RegDistrict::get();
    
    return view('pengguna.edit', [
      'pengguna' => $pengguna,
      'provinsis' => $provinsi,
      'kabupatens' => $kabupaten,
      'kecamatans' => $kecamatan,
      'level' => $level
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'telepon' => 'required',
      'alamat' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.',
      'telepon.required' => 'Telepon harus diisi.',
      'alamat.required' => 'Alamat harus diisi.'
    ]);

    $provinsi = $request->provinsi_id;

    $pengguna = Pengguna::find($id);
    $pengguna->nama = $request->nama;
    $pengguna->telepon = $request->telepon;
    $pengguna->alamat = $request->alamat;

    if ($provinsi) {
      $pengguna->provinsi_id = $request->provinsi_id;
      $pengguna->kabupaten_id = $request->kabupaten_id;
      $pengguna->kecamatan_id = $request->kecamatan_id;
    }
    $pengguna->luas_lahan = $request->luas_lahan;
    $pengguna->komoditas = $request->komoditas;
    $pengguna->save();

    return redirect()->route($pengguna->level)->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $pengguna = Pengguna::find($id);

    $user = User::find($pengguna->user_id);
    if ($user) {
      $user->roles()->detach();
      $user->permissions()->detach();
      $user->delete();
    }

    $pengguna->delete();

    return redirect()->route($pengguna->level)->with('message', 'Data berhasil dihapus');
  }

  public function akun($id)
  {
    $pengguna = Pengguna::find($id);
    $level = $pengguna->level;

    return view('pengguna.akun', [
      'pengguna' => $pengguna,
      'level' => $level
    ]);
  }

  public function akunUpdate(Request $request, $id)
  {
    $pengguna = Pengguna::find($id);
    $pengguna->email = $request->email;
    $pengguna->save();

    $user = User::find($pengguna->user_id);
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->password_show = $request->password;
    $user->save();

    return redirect()->route($pengguna->level)->with('message', 'Data berhasil diperbaharui'); 
  }

  public function permission($id)
  {
    $pengguna = Pengguna::find($id);
    $level = $pengguna->level;
    $model_has_permissions = ModelHasPermission::get();
    $permissions = Permission::get();

    return view('pengguna.permission', [
      'pengguna' => $pengguna,
      'model_has_permissions' => $model_has_permissions,
      'permissions' => $permissions,
      'level' => $level
    ]);
  }

  public function permissionUpdate(Request $request)
  {
    $pengguna = Pengguna::find($request->id);
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

    return redirect()->route($pengguna->level)->with('message', 'Permission berhasil diperbaharui.');
  }
}
