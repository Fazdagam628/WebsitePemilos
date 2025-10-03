<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->has_used) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'voted' => 'Anda sudah melakukan voting, tidak bisa login kembali.'
            ]);
        }

        if (!$user->expires_at) {
            $user->expires_at = now()->addMinutes(5);
            $user->save();
        }
        // Cek waktu expired
        if ($user->expires_at && now()->greaterThan($user->expires_at)) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['expired' => 'Waktu voting sudah habis.']);
        }

        $candidates = Candidate::all();
        $hasVoted = Vote::where('user_id', $user->id)->exists();

        return view('vote.index', compact('candidates', 'user', 'hasVoted'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user = Auth::user();

        // Cek expired
        if ($user->expires_at && now()->greaterThan($user->expires_at)) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'expired' => 'Waktu voting Anda sudah habis.'
            ]);
        }

        // Cek sudah voting
        if (Vote::where('user_id', $user->id)->exists()) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'voted' => 'Anda sudah melakukan voting!'
            ]);
        }

        // Simpan vote
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
        ]);

        $user->has_used = true;
        $user->has_expired = true;
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('success', 'Voting berhasil, terima kasih!');
    }

    /**
     * JSON data statistik (buat API)
     */
    public function stats()
    {
        $candidates = Candidate::withCount('votes')->get();

        $labels = $candidates->pluck('name');
        $data = $candidates->pluck('votes_count');

        return response()->json([
            'labels' => $labels->toArray(),
            'data' => $data->toArray(),
        ]);
    }

    public function results()
    {
        return view('dashboard');
    }
}
