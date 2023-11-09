<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', ['title' => 'Register User']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  $data['password'],
            'role_id' => '2',
            'img' => 'nullable',
        ]);

        return back()->with('success', 'Your account has been successfully registered');
    }
}
