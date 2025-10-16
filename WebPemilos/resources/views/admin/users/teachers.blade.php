<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pemilos 2025</title>
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        /* FOOTER */
        .footer {
            flex-shrink: 0;
            background-color: #800000;
            color: white;
            text-align: center;
            padding: 2rem;
            /* width: auto; */
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <!-- HEADER -->

    <!-- AREA KONTROL -->
    <section class="control-panel">
        <div class="switch-group">
            <a href="{{ route('users.students') }}" style="text-decoration: none;"><button class="switch murid" id="btnMurid">Murid</button></a>
            <a href="{{ route('users.teachers') }}" style="text-decoration: none;"><button class="switch guru" id="btnGuru">Guru</button></a>
            <a href="{{ route('users.import') }}" class="switch import" id="btnImport">Import Data</a>

        </div>
        <form action="{{ route('admin.searchTeacher') }}" method="GET" id="filterForm">
            <div class="search-bar">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari Guru..." id="searchInput" autocomplete="off">
                <button type="submit" class="btn search">Search</button>
                <!-- Tombol reset -->
                <!-- <a href="{{ route('users.students') }}" style="text-decoration: none;"><button class="btn search" style="background-color: red;color:white;">Reset</button></a> -->
            </div>
        </form>
    </section>

    <!-- STATISTIK -->
    <section class="stats">
        <div class="stat-box merah">
            <div class="icon-circle">

                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                    <path
                        d="M3 10v4h4l5 5V5L7 10H3zm13.5 2c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z" />
                </svg>
            </div>
            <div class="stat-info">
                <h2>Total Suara</h2>
                <p>{{ $totalSuara }}</p>
            </div>
        </div>

        <div class="stat-box hijau">
            <div class="icon-circle">

                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M9 16.17l-3.88-3.88L4 13.41 9 18.41 20 7.41 18.59 6l-9.59 9.59z" />
                </svg>
            </div>
            <div class="stat-info">
                <h2>Sudah Memilih</h2>
                <p>{{ $sudahMemilih  }}</p>
            </div>
        </div>

        <div class="stat-box oranye">
            <div class="icon-circle">

                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                    <path
                        d="M12 20c4.41 0 8-3.59 8-8s-3.59-8-8-8-8 3.59-8 8 3.59 8 8 8zm.5-13h-1v6l5.25 3.15.75-1.23-5-2.92V7z" />
                </svg>
            </div>
            <div class="stat-info">
                <h2>Belum Memilih</h2>
                <p>{{ $belumMemilih  }}</p>
            </div>
        </div>

        <div class="stat-box biru">
            <div class="icon-circle">

                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="24" height="24">
                    <path
                        d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                </svg>
            </div>
            <div class="stat-info">
                <h2>Total Pemilih</h2>
                <p>{{ $totalPemilih  }}</p>
            </div>
        </div>
    </section>


    <!-- TABEL DATA -->
    <section class="table-section">
        <h2>Data Guru</h2>
        <table id="tableMurid">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Token</th>
                    <th>Kode</th>
                    <th>Role</th>
                    <th>
                        Status Akun <br>
                        <form action="{{ route('admin.searchTeacher') }}" method="GET" id="filterFormStatus">
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                            <select name="status" onchange="document.getElementById('filterFormStatus').submit()" class="btn filter">
                                <option value="">-- Semua --</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </form>
                    </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}</td>
                    <td>{{ $teacher->username ?? '-' }}</td>
                    <td>{{ $teacher->token }}</td>
                    <td>{{ $teacher->nisn }}</td>
                    <td>{{ $teacher->role }}</td>
                    <td>
                        @if ($teacher->has_used || $teacher->has_expired || $teacher->expires_at)
                        <span class="status nonaktif"></span>
                        @else
                        <span class="status aktif"></span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-red btn-reset btn-delete">Hapus</button>
                        </form>
                        <form action="{{ route('admin.resetUserVote') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="keyword" value="{{ $teacher->id }}">
                            <button type="button" class="btn-red btn-reset btn-reset-vote">Reset Vote</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    <!-- Arrow -->
    @if ($teachers->hasPages())
    <section class="pagination">
        {{-- Tombol Sebelumnya --}}
        @if ($teachers->onFirstPage())
        <button disabled>&laquo;</button>
        @else
        <a href="{{ $teachers->previousPageUrl() }}"><button>&laquo;</button></a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($teachers->getUrlRange(1, $teachers->lastPage()) as $page => $url)
        @if ($page == $teachers->currentPage())
        <button class="active">{{ $page }}</button>
        @else
        <a href="{{ $url }}"><button>{{ $page }}</button></a>
        @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($teachers->hasMorePages())
        <a href="{{ $teachers->nextPageUrl() }}"><button>&raquo;</button></a>
        @else
        <button disabled>&raquo;</button>
        @endif
    </section>
    @endif
    @include('layouts.footer_home')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // === SweetAlert Konfirmasi Hapus ===
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Yakin ingin menghapus akun ini?',
                    text: 'Data akun akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // === SweetAlert Konfirmasi Reset Vote ===
        document.querySelectorAll('.btn-reset-vote').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Reset voting akun ini?',
                    text: 'Semua data voting pengguna ini akan dihapus.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Reset',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            html: 'Mohon tunggu sebentar...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        form.submit();
                    }
                });
            });
        });

        // === SweetAlert Notifikasi Sukses / Error ===
        @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: `{{ session('success') }}`,
            icon: 'success',
            confirmButtonColor: '#3085d6',
        });
        @endif

        @if(session('error'))
        Swal.fire({
            title: 'Terjadi Kesalahan!',
            text: `{{ session('error') }}`,
            icon: 'error',
            confirmButtonColor: '#d33',
        });
        @endif
    </script>

</body>


</html>
