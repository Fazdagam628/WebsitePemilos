@extends('layouts.app')
@section('title','Dashboard Admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin Pemilos</h1>

    <button><a href="{{ route('candidates.index') }}" class="btn btn-primary mb-3">👤 Kelola Kandidat</a></button>
    <button><a href="{{ route('admin.results') }}" class="btn btn-info mb-3">📈 Lihat Statistik Voting</a></button>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('#keyword').on('input', function() {
            let query = $(this).val();
            if (query.length < 2) {
                $('#user-list').empty();
                return;
            }
            $.get('{{ route("admin.searchUser") }}', {
                q: query
            }, function(data) {
                let list = '';
                if (data.length === 0) {
                    list = '<li class="list-group-item">User tidak ditemukan</li>';
                } else {
                    data.forEach(function(user) {
                        list += `<li class="list-group-item user-item" data-id="${user.id}" data-nisn="${user.nisn}">${user.id} - ${user.nisn}</li>`;
                    });
                }
                $('#user-list').html(list).show();
            });
        });

        // Klik pada list
        $(document).on('click', '.user-item', function() {
            $('#keyword').val($(this).data('id'));
            $('#user-list').empty();
        });

        // Sembunyikan list jika klik di luar
        $(document).click(function(e) {
            if (!$(e.target).closest('#keyword, #user-list').length) {
                $('#user-list').empty();
            }
        });
    });
</script>
@endsection