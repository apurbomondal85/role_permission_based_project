<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Role $role)
    {
        $permissions = Permission::get()->groupBy('group');
        // dd($permissions);

        return view('admin.pages.permission.index', compact('permissions', 'role'));
    }

    public function update(Role $role, Request $request)
    {
        $groupIds = $request->group;
        
        $role->permissions()->attach($groupIds);

        return back();
    }
}
