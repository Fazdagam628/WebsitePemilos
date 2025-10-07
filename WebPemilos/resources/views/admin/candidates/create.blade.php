<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Calon OSIS</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 650px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 0.7s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #3085d6;
            outline: none;
        }

        .btn-submit {
            background: #3085d6;
            color: #fff;
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #2563eb;
        }

        .note {
            font-size: 13px;
            color: #888;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('layouts.header')

    <!-- FORM -->
    <div class="form-container">
        <form id="candidateForm" method="POST" action="{{ route('candidates.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div>
                    <label>Nama Ketua</label>
                    <input type="text" placeholder="Masukkan nama lengkap dan kelas" name="leader_name" required>
                </div>
                <div>
                    <label>Nama Wakil</label>
                    <input type="text" placeholder="Masukkan nama lengkap" name="coleader_name" required>
                </div>

                <div>
                    <label>Visi & Misi</label>
                    <textarea placeholder="Masukkan Visi dan Misi" name="vision_mission" required></textarea>
                </div>
                <div>
                    <label>Nomor urut</label>
                    <input type="text" placeholder="Masukkan nomor urut" name="no_urut" required>

                    <label style="margin-top:18px;">Upload Foto</label>
                    <input type="file" name="candidate_photo" id="photoInput" accept="image/*">
                </div>

                <button type="submit" class="btn-submit">Tambah Paslon</button>
                <p class="note">Pastikan data sesuai dan hanya digunakan sekali</p>
            </div>
        </form>
    </div>

    @include('layouts.footer_home')

    <script>
        const form = document.getElementById('candidateForm');
        const fileInput = document.getElementById('photoInput');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // hentikan submit otomatis

            const leader = form.leader_name.value.trim();
            const coLeader = form.coleader_name.value.trim();
            const vision = form.vision_mission.value.trim();
            const noUrut = form.no_urut.value.trim();
            const file = fileInput.files[0];

            if (!leader || !coLeader || !vision || !noUrut) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data belum lengkap',
                    text: 'Pastikan semua kolom telah diisi dengan benar!',
                });
                return;
            }

            const showConfirmDialog = (previewImage = '') => {
                Swal.fire({
                    title: 'Konfirmasi Data Calon OSIS',
                    html: `
                        <div style="text-align:left;">
                            <b>Nama Ketua:</b> ${leader}<br>
                            <b>Nama Wakil:</b> ${coLeader}<br>
                            <b>Nomor Urut:</b> ${noUrut}<br><br>
                            <b>Visi & Misi:</b><br>${vision.replace(/\n/g, '<br>')}<br><br>
                            ${previewImage}
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, kirim data',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // kirim ke server Laravel
                    }
                });
            };

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const previewImage = `<img src="${e.target.result}" style="width: 300px; border-radius: 10px; margin-top: 10px;">`;
                    showConfirmDialog(previewImage);
                };
                reader.readAsDataURL(file);
            } else {
                showConfirmDialog();
            }
        });
    </script>

    {{-- SweetAlert Notifikasi Laravel --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#2563eb'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session("error") }}',
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
</body>
</html>
