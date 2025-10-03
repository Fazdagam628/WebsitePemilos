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
    $votedUsers = User::with('vote')
        ->whereHas('vote')
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
        return back()->with('success', '✅ Semua voting berhasil direset.');
    }

    public function resetUserVote(Request $request)
    {
        $request->validate(['keyword' => 'required']);

        $user = User::where('id', $request->keyword)
                    ->orWhere('name', 'like', '%' . $request->keyword . '%')
                    ->first();

        if (!$user) {
            return back()->with('error', '❌ User tidak ditemukan.');
        }

        // Hapus semua vote milik user
        Vote::where('user_id', $user->id)->delete();

        return back()->with('success', "✅ Voting user {$user->name} berhasil direset.");
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

    public function searchUser(Request $request)
    {
        $keyword = $request->get('q');
        $users = User::where('id', $keyword)
                    ->orWhere('name', 'like', "%{$keyword}%")
                    ->limit(10)
                    ->get(['id','name']);
        return response()->json($users);
    }
}
