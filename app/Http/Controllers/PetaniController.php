<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petani;

class PetaniController extends Controller
{
  public function index()
  {
    $petanis = Petani::get();

    return view('petani.index', ['petanis' => $petanis]);
  }

  public function create()
  {
    return view('petani.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.'
    ]);

    $petani = new Petani;
    $petani->nama = $request->nama;
    $petani->save();

    return redirect()->route('petani')->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $petani = Petani::find($id);
    
    return view('petani.edit', ['petani' => $petani]);
  }

  public function update(Request $request, $id)
  {
    $petani = Petani::find($id);
    $petani->nama = $request->nama;
    $petani->save();

    return redirect()->route('petani')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $petani = Petani::find($id);
    $petani->delete();

    return redirect()->route('petani')->with('message', 'Data berhasil dihapus');
  }
}
