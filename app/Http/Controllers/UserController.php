<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('name')->paginate(10);
        return view('user.index', [
            'users' => $users
        ]);
    }

    public function create(){
        $roles = Role::whereNot('name', 'Super Admin')->get();
        $permissions = Permission::get();
        return view('user.create', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'min:5', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        event(new Registered($user));

        return redirect()->route('user')->with('success', 'Data ' .$user->name. ' berhasil disimpan');
    }

    public function edit(User $user){
        $roles = Role::get();
        $permissions = Permission::get();
        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request, User $user){
        if($request->password){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'min:5', Rule::unique(User::class)->ignore($user->id)],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'is_active' => ['required'],
                'password' => ['required', Rules\Password::defaults()]
            ]);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'is_active' => $request->is_active,
                'password' => Hash::make($request->password)
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'min:5', Rule::unique(User::class)->ignore($user->id)],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'is_active' => ['required']
            ]);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'is_active' => $request->is_active
            ]);
        }

        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        if($user->wasChanged('email')){
            $user->update([
                'email_verified_at' => null
            ]);

            event(new Registered($user));
        }

        if($user->wasChanged('username') && $user->image){
            $extension = pathinfo(storage_path($user->image), PATHINFO_EXTENSION);
            $fileName = 'images/user/' . $user->username . '.' . $extension;

            Storage::move($user->image, $fileName);

            $user->update([
                'image' => $fileName
            ]);
        }
        

        return redirect()->route('user')->with('success', 'Data ' .$user->name. ' berhasil diperbarui');
    }

    public function destroy(User $user){
        if($user->blogs->count() > 0){
            return [
                'success' => false,
                'message' => 'Data '.$user->name.' tidak dapat dihapus'
            ];
        } else {
            if($user->image){
                Storage::delete($user->image);
            }
            $user->delete();

            return [
                'success' => true,
                'message' => 'Data '.$user->name.' berhasil dihapus'
            ];
        }
    }

    public function imageUpload(Request $request, User $user){
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png']
        ]);

        if($user->image){
            Storage::delete($user->image);
        }

        $file = $request->file('image');
        $image = $file->storeAs('images/user', $user->username . '.' . $file->extension());

        $user->update([
            'image' => $image
        ]);

        return redirect()->route('user')->with('success', 'Foto profil ' .$user->name. ' berhasil diperbarui');
    }

    public function imageDestroy(User $user){
        if($user->image){
            Storage::delete($user->image);
        }

        $user->update([
            'image' => null
        ]);


        return [
            'success' => true,
            'message' => 'Foto profil ' .$user->name. ' berhasil dihapus',
            'redirect' => route('user')
        ];
    }
}
