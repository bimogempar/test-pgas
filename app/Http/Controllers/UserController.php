<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function attemptLogin(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $input['email'])->first();
        if ($user && Hash::check($input['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors(['errorLogin' => 'wrong email or password']);
        }
    }

    public function registerPage()
    {
        return view('register');
    }

    public function submitRegister(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
