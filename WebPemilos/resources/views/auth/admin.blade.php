<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Selamat datang, Admin {{ $name }}!</h2>

    <p>Ini adalah halaman dashboard admin.</p>

    <a href="/dashboard">Halaman User</a><br><br>

    <form action="{{ route('logout') }}" method="GET">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
