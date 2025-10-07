<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<header>
    <div class="logo">
        <img src="SMK Logo.png" alt="Logo">
        <h1>PEMILOS 2025</h1>
    </div>
    <div class="btn">
        <a href="{{ route('home') }}" style=" text-decoration: none;"><button>Home</button></a>
        <a href="{{ route('admin.results') }}" style=" text-decoration: none;"><button class="btn">Statistik</button></a>
        <a href="{{ route('login') }}" style=" text-decoration: none;"><button class="btn">Login</button></a>
    </div>
</header>
