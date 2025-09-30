<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang, {{ $name }}!</h2>

    <p>Ini adalah halaman dashboard .</p>

    <form action="{{ route('logout') }}" method="GET">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
