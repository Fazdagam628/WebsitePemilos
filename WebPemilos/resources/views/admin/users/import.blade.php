<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Import Data</title>
    <link rel="stylesheet" href="../../css/style1.css">
    <link rel="stylesheet" href="../../css/style.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .import-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem auto;
            max-width: 600px;
            padding: 0 1rem;
        }

        .import-box {
            background: white;
            border: 2px dashed #800000;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .import-box:hover {
            background: #fff5f5;
        }

        .import-box p {
            margin-top: 1rem;
            color: #666;
        }

        #fileName {
            color: #800000;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <!-- AREA KONTROL -->
    <section class="control-panel">
        <div class="switch-group">
            <a href="{{ route('users.students') }}" style="text-decoration: none;">
                <button class="switch murid" id="btnMurid">Murid</button>
            </a>
            <a href="{{ route('users.teachers') }}" style="text-decoration: none;">
                <button class="switch guru" id="btnGuru">Guru</button>
            </a>
            <a href="{{ route('users.import') }}" class="switch import" id="btnImport">Import Data</a>
        </div>
    </section>

    <!-- IMPORT AREA -->
    <main class="import-container">
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" id="importForm"
            class="import-box">
            @csrf
            <input type="file" id="fileInput" accept=".csv, .xlsx, .xls" style="display: none" name="file" required>
            <div class="import-area" onclick="document.getElementById('fileInput').click()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="60"
                    height="60">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6h6v6m-6 0v4h6v-4m2-10h3a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2h3l2 2h4l2-2z" />
                </svg>
                <p>Klik untuk Import Data (.csv, .xlsx, .xls)</p>
            </div>
            <div id="fileName" style="margin-top: 10px; text-align: center;"></div>
            <button type="submit" class="btn-green" style="margin-top: 20px;">Import Data</button>
        </form>
    </main>

    <!-- SWEETALERT SCRIPT -->
    <script>
        const fileInput = document.getElementById("fileInput");
        const fileNameDisplay = document.getElementById("fileName");
        const importForm = document.getElementById("importForm");

        // Tampilkan nama file yang dipilih
        fileInput.addEventListener("change", function() {
            fileNameDisplay.textContent = this.files.length ? this.files[0].name : "";
        });

        // Konfirmasi sebelum submit
        importForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const file = fileInput.files[0];

            if (!file) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File belum dipilih',
                    text: 'Silakan pilih file terlebih dahulu sebelum mengimport.',
                    confirmButtonColor: '#800000'
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Import Data',
                html: `
            <p>Anda akan mengimport file berikut:</p>
            <strong style="color:#800000;">${file.name}</strong>
            <p>Pastikan format file sudah benar (.csv, .xlsx, .xls)</p>
        `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, import sekarang',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#800000',
                cancelButtonColor: '#555'
            }).then((result) => {
                if (result.isConfirmed) {
                    // 🔽 TARUH KODE LOADING DI SINI
                    Swal.fire({
                        title: 'Mengimpor Data...',
                        text: 'Harap tunggu, sistem sedang memproses file Anda.',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading(),
                    });

                    // 🔽 Lanjutkan submit form ke server
                    importForm.submit();
                }
            });
        });


        // Tampilkan notifikasi sukses/error dari backend (session flash)
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: `{{ session('success') }}`,
            confirmButtonColor: '#800000'
        });
        @endif

        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#800000'
        });
        @endif
    </script>
</body>

</html>
