@extends('layouts.app')

@section('title', 'Tambah Candidate')

@section('content')
<h2>Tambah Kandidat</h2>

<form method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
@csrf
Ketua: <input name="leader_name"><br>
Wakil Ketua: <input name="coleader_name"><br>
Deskripsi (Visi & Misi): <textarea name="vision_mission"></textarea><br>
Foto: <input type="file" name="candidate_photo">
Nomor:  <input type="number" name="no_urut" required> <br>
<button type="submit">Simpan</button>
<button><a href="{{ route('candidates.index') }}" class="btn btn-primary mb-3">back</a></button>
</form>
