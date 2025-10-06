<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fae6d6;
        }



        /* Container */
        .container {
            display: flex;
            justify-content: space-around;
            padding: 20px;
        }

        .card {
            background-color: #DED3C4;
            border-radius: 15px;
            width: 30%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-content {
            padding: 15px;
            font-size: 14px;
            text-align: justify;
        }

        .card-content textarea {
            width: 100%;
            min-height: 150px;
            border: none;
            outline: none;
            resize: none;
            background-color: #DED3C4;
            /* Menyatu dengan card */
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            padding: 8px 0;
            box-shadow: none;
        }


        .card-content h3 {
            margin-bottom: 5px;
        }

        /* Footer */
        .footer {
            background-color: #8b0000;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            position: relative;
        }






        .footer .center {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }

        .footer .buttons {
            display: flex;
            gap: 15px;
        }
    </style>
</head>

<header>
    <div class="logo">
        <img src="SMK Logo.png" alt="Logo">
        <h1>PEMILOS 2025</h1>
    </div>
    <div class="btn">
        <button><a href="{{ route('home') }}" style="color: #111; text-decoration: none;">Home</a></button>
        <button class="btn"><a href="{{ route('admin.results') }}" style="color: #111; text-decoration: none;">Statistik</a></button>
        <button class="btn"><a href="{{ route('login') }}" style="color: #111; text-decoration: none;">Login</a></button>
    </div>
</header>