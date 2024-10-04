<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->user()->isDirty('username') && auth()->user()->image) {
            $extension = pathinfo(storage_path(auth()->user()->image), PATHINFO_EXTENSION);
            $fileName = 'images/user/' . $request->user()->username . '.' . $extension;

            Storage::move(auth()->user()->image, $fileName);

            auth()->user()->update([
                'image' => $fileName
            ]);
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Successfully update profile');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function imageUpload(Request $request){
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png']
        ]);

        if(auth()->user()->image){
            Storage::delete(auth()->user()->image);
        }

        $file = $request->file('image');
        $image = $file->storeAs('images/user', auth()->user()->username . '.' . $file->extension());

        auth()->user()->update([
            'image' => $image
        ]);

        return Redirect::route('profile.edit')->with('success', 'Successfully upload image');
    }

    public function imageDestroy(){
        if(auth()->user()->image){
            Storage::delete(auth()->user()->image);
        }

        auth()->user()->update([
            'image' => null
        ]);


        return [
            'success' => true,
            'message' => 'Gambar Berhasil Dihapus'
        ];
    }
}
