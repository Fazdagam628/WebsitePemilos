<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PEMILOS 2025 - Login Siswa</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body></body>
@include('layouts.header_home')

<!-- Main Content -->
<main class="main-content">
    <!-- Informasi Penting -->
    <aside class="info">
        <h2>Informasi Penting</h2>
        <div class="info-line"></div>

        <div class="info-item">
            <div class="icon-circle">
                <!-- Ikon user -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fffacd" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zM4.8 20.4v-1.2c0-2.4 3.6-3.6 7.2-3.6s7.2 1.2 7.2 3.6v1.2H4.8z" />
                </svg>
            </div>
            <p>Setiap siswa hanya bisa memilih <strong>1 kali</strong> selama periode pemilihan</p>
        </div>

        <div class="info-item">
            <div class="icon-circle">
                <!-- Ikon jam -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fffacd" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 1 0 0.001 20.001A10 10 0 0 0 12 2zm0 1.8a8.2 8.2 0 1 1 0 16.4 8.2 8.2 0 0 1 0-16.4zm0.9 4.2h-1.8v5.4l4.5 2.7 0.9-1.5-3.6-2.1V8z" />
                </svg>
            </div>
            <p>Waktu maksimal untuk memilih adalah <strong>5 menit</strong></p>
        </div>

        <div class="info-item">
            <div class="icon-circle">
                <!-- Ikon centang -->
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#fffacd" viewBox="0 0 24 24">
                    <path d="M20.285 6.708L9 18l-5.285-5.292 1.415-1.416L9 15.171l9.87-9.879z" />
                </svg>
            </div>
            <p>Pastikan data yang dimasukkan benar dan sesuai</p>
        </div>
    </aside>

    <!-- Login Form -->
    <section class="login-form">
        <div class="form-box">
            <div class="avatar-circle">
                <!-- Ikon login -->
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#ffffff" viewBox="0 0 24 24">
                    <path d="M10 17v-3h4v-4h-4V7l-5 5 5 5zm9 4H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v4h-2V5H5v14h14v-4h2v4c0 1.1-.9 2-2 2z" />
                </svg>
            </div>

            <h2>Login Siswa</h2>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="nama-lengkap">NIS</label>
                    <div class="input-icon">
                        <!-- Ikon user -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#800000" viewBox="0 0 24 24" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:0.5;">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zM4.8 20.4v-1.2c0-2.4 3.6-3.6 7.2-3.6s7.2 1.2 7.2 3.6v1.2H4.8z" />
                        </svg>
                        <input type="text" name="nisn" id="nama-lengkap" placeholder="Masukkan NIS" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="token">TOKEN</label>
                    <div class="input-icon">
                        <!-- Ikon hashtag -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#800000" viewBox="0 0 24 24" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); opacity:0.5;">
                            <path d="M10 3L8.9 8H4v2h4.6l-.7 4H3v2h4.5l-1 5h2.1l1-5h4l-1 5h2.1l1-5H21v-2h-4.6l.7-4H21V8h-4.5l1-5h-2.1l-1 5h-4l1-5H10zm1.6 10l.7-4h4l-.7 4h-4z" />
                        </svg>
                        <input type="text" name="token" id="token" placeholder="Masukkan Token" required />
                    </div>
                </div>

                <button type="submit" class="btn-login">Mulai Memilih</button>
                <p class="form-note">Pastikan data sesuai dan hanya digunakan sekali</p>
            </form>
        </div>
    </section>
</main>

@include('layouts.footer_home')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Session Alerts -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: `{{ session('success')}}`,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: '{{ $errors->first() }}',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Tutup'
    });
</script>
@endif
</body>

</html>

</html>
