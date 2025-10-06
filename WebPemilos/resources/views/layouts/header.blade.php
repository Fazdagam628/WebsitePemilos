<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pemilos 2025</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<header class="header">
    <div class="header-left">
        <h1>Dashboard Admin</h1>
        <p>Pemilos 2025</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.dashboard') }}" class="btn tambah">Dashboard</a>
        <a href="{{ route('/candidates/create') }}" class="btn tambah">Tambah Paslon</a>
        <a href="{{ route('admin.dashboard') }}" class="btn keluar">keluar</a>
        <!-- <button href="import.html" class="btn tambah">Tambah Paslon</button>
            <button class="btn keluar">Keluar</button> -->
    </div>
</header>
