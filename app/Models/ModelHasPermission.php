<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class ModelHasPermission extends Model
{
  use HasFactory;

  public function dataPermission() {
    return $this->belongsTo(Permission::class, 'permission_id', 'id');
  }

  public function dataUser() {
    return $this->belongsTo(User::class, 'model_id', 'id');
  }
}
