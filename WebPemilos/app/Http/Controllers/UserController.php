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
        // Hitung total pengguna dengan role user
        $totalPemilih = User::where('role', 'user')->count();

        // Hitung total suara (vote)
        $totalSuara = \App\Models\Vote::count();

        // Hitung jumlah siswa yang sudah memilih
        $sudahMemilih = User::where('role', 'user')->where('has_used', 1)->count();

        // Hitung siswa yang belum memilih
        $belumMemilih = $totalPemilih - $sudahMemilih;
        // Asumsi kolom role berisi string 'user' untuk siswa
        $students = User::where('role', 'user')->orderBy('username', 'asc')->paginate(100);
        return view('admin.users.students', compact('students', 'totalPemilih', 'totalSuara', 'sudahMemilih', 'belumMemilih'));
    }
    public function teachers()
    {
        // Hitung total pengguna dengan role user
        $totalPemilih = User::where('role', 'guru')->count();

        // Hitung total suara (vote)
        $totalSuara = \App\Models\Vote::count();

        // Hitung jumlah siswa yang sudah memilih
        $sudahMemilih = User::where('role', 'guru')->where('has_used', 1)->count();

        // Hitung siswa yang belum memilih
        $belumMemilih = $totalPemilih - $sudahMemilih;
        // Asumsi kolom role berisi string 'user' untuk siswa
        $teachers = User::where('role', 'guru')->orderBy('username', 'asc')->paginate(100);
        return view('admin.users.teachers', compact('teachers', 'totalPemilih', 'totalSuara', 'sudahMemilih', 'belumMemilih'));
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
    public function userImport()
    {
        return view('admin.users.import');
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

    public function searchUser(Request $request, $role)
    {
        $keyword = $request->get('keyword');

        $query = User::where('role', $role)
            ->where(function ($q) use ($keyword) {
                $q->where('nisn', 'like', "%{$keyword}%")
                    ->orWhere('username', 'like', "%{$keyword}%")
                    ->orWhere('id', $keyword);
            });

        $results = $query->orderBy('username', 'asc')->paginate(100)->appends(['keyword' => $keyword]);

        // --- Tambahkan blok statistik agar tidak error ---
        $totalPemilih = User::where('role', $role)->count();
        $totalSuara = \App\Models\Vote::count();
        $sudahMemilih = User::where('role', $role)->where('has_used', 1)->count();
        $belumMemilih = $totalPemilih - $sudahMemilih;
        // --------------------------------------------------

        if ($role === 'user') {
            return view('admin.users.students', compact('results', 'totalPemilih', 'totalSuara', 'sudahMemilih', 'belumMemilih'))
                ->with(['students' => $results]);
        } else {
            return view('admin.users.teachers', compact('results', 'totalPemilih', 'totalSuara', 'sudahMemilih', 'belumMemilih'))
                ->with(['teachers' => $results]);
        }
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}
