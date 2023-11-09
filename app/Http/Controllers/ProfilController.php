<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function profil(Request $request)
    {
        return view('user.profil', [
            'title' => 'My Profile',
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);

        $data = $request->validate([
            'name' => 'required',
            'email' => [
                'required', 'email', Rule::unique('users')->ignore($user->id),
            ],
            'img' => 'image|max:1024',
        ]);

        if ($request->has('img')) {
            if ($user->img) {
                Storage::delete($user->img);
            }

            $path = $request->file('img')->store('user-img');
            $data['img'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Your profile has been successfully updated');
    }
}
