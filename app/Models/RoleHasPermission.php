<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermission extends Model
{
  use HasFactory;

  public function dataRole() {
    return $this->belongsTo(Role::class, 'role_id', 'id');
  }

  public function dataPermission() {
    return $this->belongsTo(Permission::class, 'permission_id', 'id');
  }
}
