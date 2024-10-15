<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::orderBy('name')->paginate(10);

        return view('role.index', [
            'roles' => $roles
        ]);
    }

    public function create(){
        $permissions = Permission::get();
        return view('role.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'unique:roles,name']
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('role')->with('success', 'Data ' .$role->name. ' berhasil disimpan');
    }

    public function edit(Role $role){
        if($role->name == 'Super Admin'){
            return redirect()->route('role')->with('warning', 'Data ' .$role->name. ' tidak dapat diedit'); 
        }  

        $permissions = Permission::get();
        return view('role.edit', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, Role $role){
        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('role')->with('success', 'Data ' .$role->name. ' berhasil diperbarui');
    }

    public function destroy(Role $role){
        if($role->name == 'Super Admin'){
            return [
                'success' => false,
                'message' => 'Data '.$role->name.' tidak dapat dihapus'
            ];
        } else {
            $role->delete();
            return [
                'success' => true,
                'message' => 'Data '.$role->name.' berhasil dihapus'
            ];
        }
    }
}
