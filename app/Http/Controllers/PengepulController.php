<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengepul;

class PengepulController extends Controller
{
  public function index()
  {
    $pengepuls = Pengepul::get();

    return view('pengepul.index', ['pengepuls' => $pengepuls]);
  }

  public function create()
  {
    return view('pengepul.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.'
    ]);

    $pengepul = new Pengepul;
    $pengepul->nama = $request->nama;
    $pengepul->save();

    return redirect()->route('pengepul')->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $pengepul = Pengepul::find($id);
    
    return view('pengepul.edit', ['pengepul' => $pengepul]);
  }

  public function update(Request $request, $id)
  {
    $pengepul = Pengepul::find($id);
    $pengepul->nama = $request->nama;
    $pengepul->save();

    return redirect()->route('pengepul')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $pengepul = Pengepul::find($id);
    $pengepul->delete();

    return redirect()->route('pengepul')->with('message', 'Data berhasil dihapus');
  }
}
