@extends('layouts.app')
@section('title','Daftar Guru')

@section('content')
<div class="container">
    <h2>Daftar Siswa</h2>
    <form action="{{ route('admin.searchStudent') }}" method="GET" id="filterForm" style="margin-bottom: 20px;">
    <div class="hero-search game">
        <div class="search-form d-flex align-items-center">
            <i data-feather="search" class="search-icon me-2"></i>
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Siswa..." id="searchInput" autocomplete="off" class="form-control me-2">

            <button type="submit" class="btn btn-primary btn-sm">Cari</button>

            <!-- Tombol reset -->
            <a href="{{ route('users.students') }}" class="btn btn-secondary btn-sm ms-2">Reset</a>
        </div>
    </div>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Token</th>
                <th>NISN</th>
                <th>Status Akun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->username ?? '-' }}</td>
                <td>{{ $student->token }}</td>
                <td>{{ $student->nisn }}</td>
                <td>
                    Digunakan:
                    @if($student->has_used)
                    <span class="badge bg-success">Sudah</span>
                    @else
                    <span class="badge bg-secondary">Belum</span>
                    @endif
                    <br>
                    Expired:
                    @if($student->has_expired)
                    <span class="badge bg-danger">Ya</span>
                    @else
                    <span class="badge bg-success">Tidak</span>
                    @endif
                    <br>
                    Expired At:
                    @if($student->expires_at)
                    {{ $student->expires_at }}
                    @else
                    -
                    @endif
                </td>
                <td>
                    <form action="{{ route('users.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus akun ini?')">Hapus</button>
                    </form>
                    <form action="{{ route('admin.resetUserVote') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="keyword" value="{{ $student->id }}">
                        <button class="btn btn-sm btn-warning" onclick="return confirm('Reset voting akun ini?')">Reset Vote</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
