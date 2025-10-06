<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pemilos 2025</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
include('../template/header.php');
?>
    <!-- HEADER -->
    <!-- <header class="header">
        <div class="header-left">
            <h1>Dashboard Admin</h1>
            <p>Pemilos 2025</p>
        </div>
        <div class="header-right">
            <a href="/2/input.html" class="btn tambah">Tambah Paslon</a>
            <a href="import.html" class="btn keluar">keluar</a> -->
            <!-- <button href="import.html" class="btn tambah">Tambah Paslon</button>
            <button class="btn keluar">Keluar</button> -->
        <!-- </div>
    </header> -->

    <!-- AREA KONTROL -->
    <section class="control-panel">
        <div class="switch-group">
            <button class="switch murid" id="btnMurid">Murid</button>
            <button class="switch guru" id="btnGuru">Guru</button>
            <a href="import.php" class="switch import" id="btnImport">Import Data</a>
            
        </div>

        <div class="search-bar">
            <input type="text" placeholder="Cari berdasarkan Nama, NIS, atau Token">
            <button class="btn search">Search</button>
        </div>
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
                <p>108</p>
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
                <p>108</p>
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
                <p>47</p>
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
                <p>155</p>
            </div>
        </div>
    </section>

    <!-- TABEL DATA -->
    <section class="table-section">
        <h2>Data Siswa</h2>
        <table id="tableMurid">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Token</th>
                    <th>Status</th>
                    <th>Reset</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Bagas Raditya Gaze</td>
                    <td>1234567891</td>
                    <td>1234</td>
                    <td><span class="status aktif"></span></td>
                    <td><button class="btn-red btn-reset">Reset</button></td>
                </tr>

            </tbody>
        </table>

        <h2 style="display:none;">Data Guru</h2>
        <table id="tableGuru" style="display:none;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Username</th>
                    <th>Token</th>
                    <th>Status</th>
                    <th>Reset</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Budi Santoso</td>
                    <td>username1</td>
                    <td>9876</td>
                    <td><span class="status nonaktif"></span></td>
                    <td><button class="btn-red btn-reset">Reset</button></td>
                </tr>

            </tbody>
        </table>
    </section>


    <!-- Arrow -->
    <section class="pagination">
        <button>&laquo;</button>
        <button class="active">1</button>
        <button>2</button>
        <button>&raquo;</button>
    </section>

</body>
<script src="script.js"></script>


</html>