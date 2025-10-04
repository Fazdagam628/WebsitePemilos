@extends('layouts.app')
@section('title','Daftar Guru')

@section('content')
<div class="container">
    <h2>Daftar Guru</h2>
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
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->username ?? '-' }}</td>
                <td>{{ $teacher->token }}</td>
                <td>{{ $teacher->nisn }}</td>
                <td>
                    Digunakan:
                    @if($teacher->has_used)
                    <span class="badge bg-success">Sudah</span>
                    @else
                    <span class="badge bg-secondary">Belum</span>
                    @endif
                    <br>
                    Expired:
                    @if($teacher->has_expired)
                    <span class="badge bg-danger">Ya</span>
                    @else
                    <span class="badge bg-success">Tidak</span>
                    @endif
                    <br>
                    Expired At:
                    @if($teacher->expires_at)
                    {{ $teacher->expires_at }}
                    @else
                    -
                    @endif
                </td>
                <td>
                    <form action="{{ route('users.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus akun ini?')">Hapus</button>
                    </form>
                    <form action="{{ route('users.resetVote') }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="keyword" value="{{ $teacher->id }}">
                        <button class="btn btn-sm btn-warning" onclick="return confirm('Reset voting akun ini?')">Reset Vote</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection