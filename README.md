# ToDo Sistem Voting Ketua & Wakil OSIS

## Backend
1. Membuat sistem login MultiRole (Admin, User/Siswa)
2. Membuat database untuk menyimpan data user, kandidat, dan hasil votings
3. Buat role type dan role access admin dan user
4. Membuat CRUD data kandidat pasangan Ketua & Wakil OSIS. Buat juga fitur upload foto kandidat
5. Membuat Sistem import data NISN dan Password User dari Excel ke Database
6. Membuat sistem voting dengan validasi user (hanya user terdaftar yang bisa voting)
7. Membuat validasi agar user hanya bisa voting satu kali (gunakan token)
8. Berikan waktu voting yang terbatas (misal: 5 Menit)
9. Membuat dashboard admin untuk memantau hasil voting secara real-time (opsional: grafik atau bisa dicek juga penggunaan laravel pulse)
10. Membuat fitur reset voting untuk admin dan user
11. Membuat middleware agar hanya admin yang bisa mengakses halaman admin

## Frontend
1. Membuat halaman login
2. Buat form untuk memasukkan token setelah login sebagai user
3. Membuat halaman daftar kandidat pasangan Ketua & Wakil OSIS
4. Membuat halaman voting untuk user
5. Tampilkan timer countdown pada halaman voting
6. Membuat halaman dashboard admin (menampilkan hasil voting)
7. Membuat popup konfirmasi setelah voting (Bisa menggunakan SweetAlert)
8. Membuat notifikasi/error handling pada frontend

## Deployment & Testing
1. Menyiapkan database (MySQL dan disambungkan dengan API ke Firebase)
2. Melakukan testing fitur utama (login, voting, hasil voting)
3. Deploy project ke server
