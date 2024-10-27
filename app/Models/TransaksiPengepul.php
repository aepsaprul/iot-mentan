<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPengepul extends Model
{
  use HasFactory;

  public function dataPengepul() {
    return $this->belongsTo(Pengepul::class, 'pengepul_id', 'id');
  }

  public function dataPetani() {
    return $this->belongsTo(Petani::class, 'petani_id', 'id');
  }
}
