<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleHasPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
  public function index()
  {
    $permissions = Permission::orderBy('id', 'desc')->get();
    $roles = Role::orderBy('id', 'desc')->get();

    return view('permission.index', [
      'permissions' => $permissions,
      'roles' => $roles
    ]);
  }

  public function create()
  {
    return view('permission.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'menu' => 'required',
      'name' => 'required|unique:permissions'
    ], [
      'menu.required' => 'Menu harus diisi.',
      'name.required' => 'Permission harus diisi.',
      'name.unique' => 'Permission sudah ada.'
    ]);

    $permission = new Permission;
    $permission->menu = $request->menu;
    $permission->name = $request->name;
    $permission->guard_name = "web";
    $permission->save();

    return redirect()->route('permission')->with('message_permission', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $permission = Permission::find($id);

    return view('permission.edit', ['permission' => $permission]);
  }

  public function update(Request $request, $id)
  {
    $permission = Permission::find($id);
    $permission->name = $request->name;
    $permission->guard_name = "web";
    $permission->save();

    return redirect()->route('permission')->with('message_permission', 'Data berhasil diperbaharui.');
  }

  public function delete($id)
  {
    $permission = Permission::find($id);
    $permission->delete();

    return redirect()->route('permission')->with('message_permission', 'Data berhasil dihapus.');
  }

  public function roleCreate()
  {
    return view('permission.createRole');
  }

  public function roleStore(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:roles'
    ], [
      'name.required' => 'Role harus diisi.',
      'name.unique' => 'Role sudah ada.'
    ]);

    $role = new Role;
    $role->name = $request->name;
    $role->guard_name = "web";
    $role->save();

    return redirect()->route('permission')->with('message_role', 'Data berhasil ditambahkan.');
  }

  public function roleEdit($id)
  {
    $role = Role::find($id);

    return view('permission.editRole', ['role' => $role]);
  }

  public function roleUpdate(Request $request, $id)
  {
    $role = Role::find($id);
    $role->name = $request->name;
    $role->guard_name = "web";
    $role->save();

    return redirect()->route('permission')->with('message_role', 'Data berhasil diperbaharui.');
  }

  public function roleHasPermission($id)
  {
    $role = Role::find($id);
    $role_has_permission = RoleHasPermission::get();
    $permissions = Permission::orderBy('menu', 'asc')
      ->orderBy('name', 'asc')
      ->get();
    
    return view('permission.roleHasPermission', [
      'role' => $role,
      'permissions' => $permissions,
      'role_has_permissions' => $role_has_permission
    ]);
  }

  public function roleHasPermissionUpdate(Request $request)
  {
    $req_role_id = $request->role_id;
    $req_role = $request->role;
    $req_permission = $request->input('permission');

    $permission_db = RoleHasPermission::where('role_id', $req_role_id);
    if ($permission_db) {
      $permission_db->delete();
    }
    
    $role = Role::findByName($req_role);

    foreach ($req_permission as $key => $value) {
      $role->givePermissionTo($value);
    }
    
    return redirect()->route('permission')->with('message_role', 'Permission berhasil ditambahkan');
  }

  public function roleDelete($id)
  {
    $role = Role::find($id);
    $role->delete();

    return redirect()->route('permission')->with('message_role', 'Data berhasil dihapus');
  }
}
