<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
    function role(){
        // $role = Role::create(['name' => 'Subscriber']);
        // $permission = Permission::create(['name' => 'restore category']);
        return view('backend.role',[
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'users' => User::all(),
        ]);
    }
    function RoleAddToPermission(Request $request){
        $role_name = $request->role_name;
        $permission_name = $request->permission_name;
        $role = Role::where('name',$role_name)->first();
        // Multiple Role
        $role->givePermissionTo($permission_name);
        // Sungle Role
        // $role->syncPermissions($permission_name);
        return back();
    }
    function RoleAddToUser(Request $request){
        $user_id = $request->user_id;
        $role_name = $request->role_name;
        $user = User::findOrFail($user_id);
        // Multiple Role
        $user->assignRole($role_name); //syncRoles
        // Sungle Role
        // $role->syncPermissions($permission_name);
        return back();
    }
}
