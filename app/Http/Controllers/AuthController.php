<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view ('auth/login');
    }

    public function register()
    {
        return view ('auth/register');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required'
        ]);  

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]); 

        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect()->intended('/');
        }

        return redirect('/login');
    }

    public function sign_out()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }
}
