<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request) {

        $request->validate([
            'name'      => ['required'],
            'email'     => ['required'],
            'username'  => ['required', 'max:50'],
            'password'  => ['required', 'min:6', 'max:50']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username'  => $request->username,
            'password' => Hash::make($request->password)
        ]);
    }
}
