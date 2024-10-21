<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eksportir;

class EksportirController extends Controller
{
  public function index()
  {
    $eksportirs = Eksportir::get();

    return view('eksportir.index', ['eksportirs' => $eksportirs]);
  }

  public function create()
  {
    return view('eksportir.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required'
    ], [
      'nama.required' => 'Nama harus diisi.'
    ]);

    $eksportir = new Eksportir;
    $eksportir->nama = $request->nama;
    $eksportir->save();

    return redirect()->route('eksportir')->with('message', 'Data berhasil ditambahkan');
  }

  public function edit($id)
  {
    $eksportir = Eksportir::find($id);
    
    return view('eksportir.edit', ['eksportir' => $eksportir]);
  }

  public function update(Request $request, $id)
  {
    $eksportir = Eksportir::find($id);
    $eksportir->nama = $request->nama;
    $eksportir->save();

    return redirect()->route('eksportir')->with('message', 'Data berhasil diperbaharui');
  }

  public function delete($id)
  {
    $eksportir = Eksportir::find($id);
    $eksportir->delete();

    return redirect()->route('eksportir')->with('message', 'Data berhasil dihapus');
  }
}
