<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
  use HasFactory;

  protected $fillable = [
    'id',
    'nama'
  ];
}
