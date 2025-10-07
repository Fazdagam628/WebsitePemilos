<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMILOS 2025</title>
    <link rel="stylesheet" href="../css/styleUser.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #8b0000;
            color: white;
            padding: 10px 20px;
        }

        .header .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header img {
            width: 60px;
            height: 60px;
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #DED3C4;
            border-radius: 15px;
            width: 280px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn-pilih {
            background-color: #8b0000;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-pilih:hover {
            background-color: #b22222;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="SMK Logo.png" alt="Logo">
            <h1>PEMILOS 2025</h1>
        </div>

        @if($user->expires_at)
        <div class="timer">
            <span>TIMER</span>
            <div class="time" id="countdown">05:00</div>
        </div>

        <script>
            // Hitung mundur (JS countdown + auto redirect)
            let expireTime = new Date("{{ $user->expires_at}}").getTime();
            let interval = setInterval(function() {
                let now = new Date().getTime();
                let distance = expireTime - now;

                if (distance <= 0) {
                    clearInterval(interval);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Waktu Habis',
                        text: 'Waktu login Anda telah berakhir!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ route('login') }}";
                    });
                } else {
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("countdown").innerHTML =
                        // `Sisa waktu Voting: ${minutes} menit ${seconds} detik`;
                        `${minutes} menit ${seconds} detik`;
                }
            }, 1000);
        </script>
        @endif
    </div>

    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
    <p style="color:red;">{{ $errors->first() }}</p>
    @endif

    @if($hasVoted)
    <p>Anda sudah melakukan voting. Terima kasih!</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @else

    <!-- SECTION PILIH CALON -->
    <div id="pilihSection" class="container">
        @foreach($candidates as $candidate)
        <div class="card">
            <img src="{{ asset('storage/' . $candidate->candidate_photo) }}" alt="Foto Kandidat"
                class="candidate-photo">
            <p>Calon Ketua OSIS<br><strong>{{ $candidate->leader_name }}</strong></p>
            <p>Calon Wakil Ketua OSIS<br><strong>{{ $candidate->coleader_name }}</strong></p>

            <form method="POST" action="{{ route('vote.store') }}" class="vote-form">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                <button type="button" class="btn-pilih" data-name="{{ $candidate->leader_name }}"
                    data-img="{{ asset('storage/' . $candidate->candidate_photo) }}">Vote</button>
            </form>
        </div>
        @endforeach
    </div>
    @endif

    @include('layouts.footer_home')
    <script>
        // SweetAlert Konfirmasi Vote
        document.querySelectorAll('.btn-pilih').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.vote-form');
                const candidateName = this.getAttribute('data-name');
                const candidateImg = this.getAttribute('data-img');

                Swal.fire({
                    title: 'Konfirmasi Pilihan Anda',
                    html: `
                        <img src="${candidateImg}" alt="Kandidat" style="width: 300px; border-radius: 10px; margin-bottom: 10px;">
                        <p>Apakah Anda yakin ingin memilih <strong>${candidateName}</strong> sebagai Ketua OSIS?</p>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, saya yakin',
                    cancelButtonText: 'Batal',
                    focusCancel: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>