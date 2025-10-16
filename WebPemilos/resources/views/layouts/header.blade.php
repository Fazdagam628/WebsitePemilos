<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pemilos 2025</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleHome.css">
    <style>
        /* Animasi fade-out */
        .fade-out {
            animation: fadeOut 0.8s ease forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: scale(0.98);
            }
        }

        /* Spinner animasi */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<header class="header">
    <div class="header-left">
        <h1>Dashboard Admin</h1>
        <p>Pemilos 2025</p>
    </div>
    <div class="header-right">
        <a href="{{ route('users.students') }}" class="btn tambah">Dashboard</a>
        <a href="{{ route('candidates.create') }}" class="btn tambah">Tambah Paslon</a>
        <a href="{{ route('admin.results') }}" class="btn tambah">Statistik</a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <a style="text-decoration: none;"><button type="button" class="btn keluar" id="logoutBtn">keluar</button></a>
        </form>
        <!-- <button href="import.html" class="btn tambah">Tambah Paslon</button>
            <button class="btn keluar">Keluar</button> -->
    </div>
</header>
