<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
  use HasFactory;

  public function dataUser() {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function dataProvinsi() {
    return $this->belongsTo(RegProvince::class, 'provinsi_id', 'id');
  }

  public function dataKabupaten() {
    return $this->belongsTo(RegRegency::class, 'kabupaten_id', 'id');
  }

  public function dataKecamatan() {
    return $this->belongsTo(RegDistrict::class, 'kecamatan_id', 'id');
  }
}
