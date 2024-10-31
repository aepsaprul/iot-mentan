<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
  use HasFactory;

  public function dataPengguna() {
    return $this->belongsTo(Pengguna::class, 'pengguna_id', 'id');
  }

  public function dataPenjual() {
    return $this->belongsTo(Pengguna::class, 'penjual_id', 'id');
  }
}
