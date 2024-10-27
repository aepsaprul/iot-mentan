<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPetani extends Model
{
  use HasFactory;

  public function dataPetani() {
    return $this->belongsTo(Petani::class, 'petani_id', 'id');
  }
}
