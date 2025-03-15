<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();

        return view('admin.pages.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.pages.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        try {
            $slug = Str::slug($request->name);
           
            Role::create([
                'name' => $request->name,
                'slug' => $slug
            ]);
    
            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('role.create')->with('error', 'Failed to create role.');
        }
    }

    public function edit(Role $role)
    {
        return view('admin.pages.role.update', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' =>'required|string|max:255',
        ]);

        try {
            $slug = Str::slug($request->name);
           
            $role->update([
                'name' => $request->name,
                'slug' => $slug
            ]);
    
            return redirect()->route('role.index')->with('success', 'Role created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('role.edit')->with('error', 'Failed to create role.')->withInput($request->all());
        }
    }

    public function delete(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('role.index')->with('success', 'Role deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('role.index')->with('error', 'Failed to delete role.');
        }
    }
}
