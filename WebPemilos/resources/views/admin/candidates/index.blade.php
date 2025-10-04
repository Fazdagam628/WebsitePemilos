@extends('layouts.app')

@section('title', 'Candidate')

@section('content')
<h2>Kelola Kandidat</h2>
<button><a href="{{ route('candidates.create') }}">Tambah Kandidat</a></button>
<button><a href="{{ route('admin.dashboard') }}">kembali</a></button>
<table border="1">
    <tr>
        <th>No Urut</th>
        <th>Foto</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    @foreach($candidates as $c)
    <tr>
        <td>{{ $c->no_urut }}</td>
        <td><img src="{{ asset('storage/' . $c->candidate_photo) }}" width="100"></td>
        <td><textarea>{{ $c->vision_mission }}</textarea></td>
        <td>
            <button><a href="{{ route('candidates.edit',$c) }}">Edit</a></button>
            <form method="POST" action="{{ route('candidates.destroy',$c) }}" style="display:inline">
                @csrf @method('DELETE')
                <button>Hapus</button>
            </form>
        </td>
    </tr>

    @endforeach
</table>
