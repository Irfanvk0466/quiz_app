<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Hash;
use App\Http\Requests\StudentRegisterRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
 
    public function register() 
    {
        return view('register');

    }

    public function studentRegister(StudentRegisterRequest $request)
    {
        $hashedPassword = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);
        return back()->with('success', 'Registration Successful!..');
    }

    public function login() 
    {
        return view('login');

    }

    public function studentLogin(Request $request)
    {
        $loginCredentials = $request->only('username', 'password');
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            return redirect('/categories');
        } else {
            return back()->with('error', 'Invalid login credentials...');
        }
    }
}
