<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signIn() {
        return view('auth/signin');
    }

    public function register(Request $request) {
        $request -> validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);

        return redirect() -> route('login');
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentails = $request -> validate([
            'email' => 'email|required',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentails)) {
            $request -> session() -> regenerate();
            
            return redirect() -> intended('/');
        }

        return back() -> withErrors([
            'email' => 'Полученные данные не были найдены.',
        ]) -> onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return back();
    }
}
