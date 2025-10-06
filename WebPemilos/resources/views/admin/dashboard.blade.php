@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin Pemilos</h1>

    <button><a href="{{ route('candidates.index') }}" class="btn btn-primary mb-3">👤 Kelola Kandidat</a></button>
    <button><a href="{{ route('admin.results') }}" class="btn btn-info mb-3">📈 Lihat Statistik Voting</a></button>
    <button><a href="{{ route('users.students') }}" class="btn btn-info mb-3">Daftar siswa</a></button>
    <button><a href="{{ route('users.teachers') }}" class="btn btn-info mb-3">Daftar Guru</a></button>
    <button><a href="{{ route('users.importForm') }}" class="btn btn-info mb-3">upload File</a></button>

    <h3>Total Suara Masuk: {{ $totalVotes }}</h3>

    <table class="table table-bordered">
        <tr>
            <th>Nama Kandidat</th>
            <th>Jumlah Suara</th>
        </tr>
        @foreach($candidates as $c)
        <tr>
            <td>{{ $c->no_urut }}</td>
            <td>{{ $c->votes_count }}</td>
        </tr>
        @endforeach
    </table>

    <form method="POST" action="{{ route('admin.resetVotes') }}">
        @csrf
        <button class="btn btn-danger">Reset Semua Voting</button>
    </form>

    <hr>

    <h4>Reset Voting User</h4>
    <form method="POST" action="{{ route('admin.resetUserVote') }}">
        @csrf
        <div class="mb-3 position-relative">
            <label for="keyword">Cari User (ID atau Nama):</label>
            <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Masukkan ID atau Nama user" autocomplete="off">
            <ul id="user-list" class="list-group position-absolute w-100" style="z-index:1000;"></ul>
        </div>
        <button class="btn btn-warning">Reset Voting User</button>
    </form>

    <hr>
    <h4>Daftar User yang Sudah Voting</h4>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>reset vote</th>
        </tr>
        @foreach($votedUsers as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>
                <form method="POST" action="{{ route('admin.resetUserVote') }}" style="display:inline;">
                    @csrf
                    <input type="hidden" name="keyword" value="{{ $user->id }}">
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin reset voting user {{ $user->name }}?')">Reset</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <hr>
    <h4>Monitoring Sistem</h4>
    <p>
        Untuk memantau aktivitas real-time aplikasi, buka halaman
        <a href="{{ url('/pulse') }}" target="_blank">Laravel Pulse</a>.
    </p>
</div>
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@if(session('error'))
<script>
    alert("{{ session('error') }}");
</script>
@endif
@endsection
