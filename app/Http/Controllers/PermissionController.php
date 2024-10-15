<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::orderBy('name')->paginate(10);
        return view('permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create(){
        return view('permission.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'unique:permissions,name']
        ]);

        $permission = Permission::create([
            'name' => $request->name
        ]);

        return redirect()->route('permission')->with('success', 'Data ' .$permission->name. ' berhasil disimpan');
    }

    public function edit(Permission $permission){
       return view('permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission){
        $request->validate([
            'name' => ['required', 'unique:permissions,name,' . $permission->id]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('permission')->with('success', 'Data ' .$permission->name. ' berhasil diperbarui');
    }

    public function destroy(Permission $permission){
        $permission->delete();
        return [
            'success' => true,
            'message' => 'Data '.$permission->name.' berhasil dihapus'
        ];
    }
}
