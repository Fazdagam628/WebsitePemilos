<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PEMILOS 2025</title>
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

<body>
    @include('layouts.header_home')
    <!-- Cards -->
    <div class="container">
        @foreach ($candidates as $candidate)

        <!-- Card 1 -->
        <div class="card">
            <img src="{{ asset('storage/' . $candidate->candidate_photo) }}" alt="Calon 1">
            <div class="card-content">
                <h3 style="text-align: center;">No Urut {{ $candidate->no_urut }}</h3>
                <h3>Visi dan Misi</h3>
                <p>
                    <textarea name="" id="" cols="30" rows="10" readonly>{{ $candidate->vision_mission }}</textarea>
                </p>
            </div>
        </div>
        @endforeach

        <!-- Card 2 -->
        <!-- <div class="card">
        <img src="Screenshot (19).png" alt="Calon 2">
        <div class="card-content">
            <h3>Visi</h3>
            <p>1. Memajukan sekolah blablalablablablabbalalaabblablablabba akzsisaisijisjksajfbshasijlfjasjfksmfios<br>
                2. membuat murid fuehfuhfjlasiejbagdsiogsiaigafawwwwwwwww sfsamufuhfasuhufdahsida<br>
                3. membuat sekolah naifnabufuhfasuyguyUCNVJNUISAlsdnufahfnananmanananm...</p>

            <h3>Misi</h3>
            <p>1. Memajukan sekolah blablalablablablabbalalaabblablablabba akzsisaisijisjksajfbshasijlfjasjfksmfios<br>
                2. membuat murid fuehfuhfjlasiejbagdsiogsiaigafawwwwwwwww sfsamufuhfasuhufdahsida<br>
                3. membuat sekolah naifnabufuhfasuyguyUCNVJNUISAlsdnufahfnananmanananm...<br>
                4. fawunmmmmmmmmmmmmmmmmmmmmmmmmmmmnnnnnnnnnnnnnnnnnnnnnfw wadiiiiiiiiiiiiiiliikfaoooijiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiffffffnjnn</p>
        </div>
    </div> -->

        <!-- Card 3 -->
        <!-- <div class="card">
        <img src="Screenshot (16).png" alt="Calon 3">
        <div class="card-content">
            <h3>Visi</h3>
            <p>1. Memajukan sekolah blablalablablablabbalalaabblablablabba akzsisaisijisjksajfbshasijlfjasjfksmfios<br>
                2. membuat murid fuehfuhfjlasiejbagdsiogsiaigafawwwwwwwww sfsamufuhfasuhufdahsida<br>
                3. membuat sekolah naifnabufuhfasuyguyUCNVJNUISAlsdnufahfnananmanananm...</p>

            <h3>Misi</h3>
            <p>1. Memajukan sekolah blablalablablablabbalalaabblablablabba akzsisaisijisjksajfbshasijlfjasjfksmfios<br>
                2. membuat murid fuehfuhfjlasiejbagdsiogsiaigafawwwwwwwww sfsamufuhfasuhufdahsida<br>
                3. membuat sekolah naifnabufuhfasuyguyUCNVJNUISAlsdnufahfnananmanananm...<br>
                4. fawunmmmmmmmmmmmmmmmmmmmmmmmmmmmnnnnnnnnnnnnnnnnnnnnnfw wadiiiiiiiiiiiiiiliikfaoooijiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiffffffnjnn</p>
        </div>
    </div> -->
    </div>
    @include('layouts.footer_home')
    </div>

</body>

</html>
