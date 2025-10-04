@extends('layouts.app')

@section('title', 'Edit Candidate')

@section('content')
<h2>Edit Kandidat</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('candidates.update', $candidate->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kandidat</label>
        <input type="text" name="name" value="{{ old('name', $candidate->name) }}" class="form-control">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Nomor Urut</label>
        <input type="number" name="number" value="{{ old('number', $candidate->number) }}" class="form-control">
        @error('number') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Deskripsi (Visi & Misi)</label>
        <textarea name="description" class="form-control">{{ old('description', $candidate->description) }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label>Foto Saat Ini</label><br>
        @if($candidate->photo)
            <img src="{{ asset('storage/' . $candidate->photo) }}" width="150" alt="{{ $candidate->name }}">
        @else
            <p>- Tidak ada foto -</p>
        @endif
    </div>

    <div class="mb-3">
        <label>Ganti Foto (Opsional)</label>
        <input type="file" name="photo" class="form-control">
        @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
