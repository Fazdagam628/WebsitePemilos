<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function home()
    {
        $candidates = Candidate::get();
        return view('auth.home',compact('candidates'));
    }
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

        if (!$user) {
            return back()->withErrors(['nisn' => 'NISN tidak ditemukan.']);
        }

        // Bandingkan token secara langsung (plaintext)
        if ($request->token !== $user->token) {
            return back()->withErrors(['token' => 'Token tidak valid.']);
        }

        // Cegah login ulang jika sudah vote
        if (\App\Models\Vote::where('user_id', $user->id)->exists()) {
            return back()->withErrors(['msg' => 'Anda sudah memberikan vote, login tidak diperbolehkan.']);
        }

        // Login aman
        Auth::login($user);

        // Arahkan sesuai role
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('vote.index');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
