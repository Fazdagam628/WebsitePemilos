<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Import Data</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- HEADER -->
       <?php
include('../template/header.php');
?>
    <!-- <header class="header">
        <div class="logo">
            <h1>Dashboard Admin</h1>
            <span>Pemilos 2025</span>
        </div>
        <div class="header-actions">
            <button class="btn-red">Tambah Paslon</button>
            <button class="btn-yellow">Keluar</button>
        </div>
    </header> -->

    <!-- SWITCH Button -->
    <section class="control-panel">
        <div class="switch-group">
            <button class="switch murid" id="btnMurid">Murid</button>
            <button class="switch guru" id="btnGuru">Guru</button>
            <button class="switch import" id="btnImport">Import Data</button>
        </div>
    </section>


    <!-- IMPORT AREA -->
    <main class="import-container">
        <form id="importForm" class="import-box">
            <input type="file" id="fileInput" accept=".csv, .xlsx, .xls" style="display: none">
            <div class="import-area" onclick="document.getElementById('fileInput').click()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="black" width="60"
                    height="60">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6h6v6m-6 0v4h6v-4m2-10h3a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2h3l2 2h4l2-2z" />
                </svg>
                <p>Klik untuk Import Data (.csv, .xlsx, .xls)</p>
            </div>
            <div id="fileName" style="margin-top: 10px; text-align: center;"></div>
            <button type="submit" class="btn-green" style="margin-top: 20px; display: none;">Import Data</button>
        </form>
    </main>
</body>

</html>