@extends('layouts.app')
@section('title','Import data')

@section('content')

<h2>Import Data user</h2>
<form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Pilih file Excel (.xlsx atau .xls):</label>
        <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
    </div>
    <button type="submit" class="btn btn-primary">Import</button>
</form>
@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif
@endsection