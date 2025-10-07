<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    // Menampilkan semua kandidat
    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
    }

    // Menampilkan form create
    public function create()
    {
        return view('admin.candidates.create');
    }

    // Simpan kandidat baru
    public function store(Request $r)
    {
        try {
            $data = $r->validate([
                'leader_name' => 'required',
                'coleader_name' => 'required',
                'vision_mission' => 'required',
                'no_urut' => 'required|integer|unique:candidates,no_urut',
                'candidate_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            if ($r->hasFile('candidate_photo')) {
                $data['candidate_photo'] = $r->file('candidate_photo')->store('candidates', 'public');
            }

            Candidate::create($data);

            return redirect()->route('candidates.create')->with('success', 'Data calon OSIS berhasil ditambahkan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }


    // Menampilkan form edit
    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    // Update kandidat
    public function update(Request $r, Candidate $candidate)
    {
        $data = $r->validate([
            'leader_name' => 'required',
            'coleader_name' => 'required',
            'vision_mission' => 'required',
            'no_urut' => 'required|integer|unique:candidates,no_urut,' . $candidate->id,
            'candidate_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // foto optional
        ]);

        if ($r->hasFile('candidate_photo')) {
            // Hapus file lama jika ada
            if ($candidate->candidate_photo && Storage::disk('public')->exists($candidate->candidate_photo)) {
                Storage::disk('public')->delete($candidate->candidate_photo);
            }
            $data['candidate_photo'] = $r->file('candidate_photo')->store('candidates', 'public');
        }

        // Update kandidat
        $candidate->update($data);

        return redirect()->route('candidates.update')->with('success', 'Candidate updated successfully!');
    }

    // Hapus kandidat
    public function destroy(Candidate $candidate)
    {
        // Hapus foto jika ada
        if ($candidate->candidate_photo && Storage::disk('public')->exists($candidate->candidate_photo)) {
            Storage::disk('public')->delete($candidate->candidate_photo);
        }

        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully!');
    }
}
