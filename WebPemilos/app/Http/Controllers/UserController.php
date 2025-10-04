<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function students()
    {
        // Asumsi kolom role berisi string 'user' untuk siswa
        $students = User::where('role', 'user')->get();
        return view('users.students', compact('students'));
    }
    public function teachers()
    {
        // Asumsi kolom role berisi string 'user' untuk siswa
        $teachers = User::where('role', 'guru')->get();
        return view('users.teachers', compact('teachers'));
    }
    public function resetVotes()
    {
        // Hapus semua vote
        Vote::truncate();
        // Reset semua user
        User::query()->update([
            'has_used' => 0,
            'has_expired' => 0,
            'expires_at' => null
        ]);
        return back()->with('success', '✅ Semua voting berhasil direset.');
    }

    public function resetUserVote(Request $request)
    {
        $request->validate(['keyword' => 'required']);

        $user = User::where('id', $request->keyword)
            ->orWhere('nisn', 'like', '%' . $request->keyword . '%')
            ->first();

        if (!$user) {
            return back()->with('error', '❌ User tidak ditemukan.');
        }

        // Hapus semua vote milik user
        Vote::where('user_id', $user->id)->delete();
        // Reset used_at dan session
        $user->has_used = 0;
        $user->has_expired = 0;
        $user->expires_at = null;
        $user->save();

        return back()->with('success', "✅ Voting user {$user->nisn} berhasil direset.");
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Log::info('Proses import dimulai...');

        Excel::import(new UsersImport, $request->file('file'));

        // Log::info('Proses import selesai.');

        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:6'
            'token' => 'required|string|max:255',
        ]);

        User::create([
            'nisn' => $request->nisn,
            // 'email' => $request->email,
            'role' => isset($request->role),
            // 'password' => Hash::make($request->password),
            'token' => $request->token,
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan!');
    }

    public function searchUser(Request $request)
    {
        $keyword = $request->get('q');
        $users = User::where('id', $keyword)
            ->orWhere('nisn', 'like', "%{$keyword}%")
            ->limit(10)
            ->get(['id', 'nisn']);
        return response()->json($users);
    }
}
