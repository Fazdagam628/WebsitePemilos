<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vote;
use App\Models\Candidate;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $candidates = Candidate::withCount('votes')->get();
        $totalVotes = Vote::count();

        // ✅ Ambil semua user yang sudah voting (1 user = 1 vote)
        $votedUsers = User::with('votes')
            ->whereHas('votes')
            ->get();

        return view('admin.dashboard', compact('candidates', 'totalVotes', 'votedUsers'));
    }

    //     public function statistics()
    //     {
    //         return view('admin.statistics');
    //     }
    //
    //     public function voteStats()
    //     {
    //         $candidates = Candidate::withCount('votes')->get(['id','name']);
    //         return response()->json([
    //             'labels' => $candidates->pluck('name'),
    //             'data'   => $candidates->pluck('votes_count')
    //         ]);
    //     }

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
