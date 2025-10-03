<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'token' => 'required|string',
        ]);

        $user = User::where('nisn', $request->nisn)->first();

        if ($user && Hash::check($request->token, $user->token)) {
            Auth::login($user);

            if ($user->id_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('vote.index');
            }
        }
            if (\App\Models\Vote::where('user_id', $user->id)->exist()) {
                return back()->withErrors(['msg' => 'Anda sudah memberikan vote, login tidak diperbolehkan.']);
            }

        return back()->withErrors(['nisn' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
