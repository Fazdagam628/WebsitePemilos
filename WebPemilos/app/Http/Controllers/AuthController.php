<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login
    public function login(Request $request)
{
    $request->validate([
        'nis' => 'required',
        'password' => 'required'
    ]);

    $user = User::where('nis', $request->nis)->first();

    if ($user && password_verify($request->password, $user->password)) {
        // simpan session
        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('is_admin', $user->is_admin);

        // redirect berdasarkan role
        if ($user->is_admin) {
            return redirect('/admin');
        } else {
            return redirect('/dashboard');
        }
    }

    return back()->withErrors([
        'nis' => 'NIS atau password salah.',
    ]);
}


    // logout
    public function logout(Request $request)
    {
        $request->session()->flush(); // hapus semua session
        return redirect('/login');
    }

    // tampilkan dashboard
    public function dashboard(Request $request)
    {
        if (!$request->session()->has('user_id')) {
            return redirect('/login'); // kalau belum login
        }

        $name = $request->session()->get('user_name');
        return view('auth.dashboard', compact('name'));
}

public function adminDashboard(Request $request)
{
    if (!$request->session()->has('user_id') || !$request->session()->get('is_admin')) {
        return redirect('/login'); // hanya admin
    }

    $name = $request->session()->get('user_name');
    return view('auth.admin', compact('name'));
}

}
