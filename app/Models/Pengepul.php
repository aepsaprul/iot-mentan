<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengepul extends Model
{
  use HasFactory;

  public function dataUser() {
    return $this->hasOne(User::class, 'id', 'user_id');
  }
}
