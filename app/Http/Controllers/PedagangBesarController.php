<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedagangBesar;

class PedagangBesarController extends Controller
{
  public function index()
  {
    $pedagang_besars = PedagangBesar::get();

    return view('pedagang_besar.index', ['pedagang_besars' => $pedagang_besars]);
  }

  public function create()
  {
    return view('pedagang_besar.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.'
    ]);

    $pedagang_besar = new PedagangBesar;
    $pedagang_besar->nama = $request->nama;
    $pedagang_besar->save();

    return redirect()->route('pedagang_besar')->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $pedagang_besar = PedagangBesar::find($id);
    
    return view('pedagang_besar.edit', ['pedagang_besar' => $pedagang_besar]);
  }

  public function update(Request $request, $id)
  {
    $pedagang_besar = PedagangBesar::find($id);
    $pedagang_besar->nama = $request->nama;
    $pedagang_besar->save();

    return redirect()->route('pedagang_besar')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $pedagang_besar = PedagangBesar::find($id);
    $pedagang_besar->delete();

    return redirect()->route('pedagang_besar')->with('message', 'Data berhasil dihapus');
  }
}
