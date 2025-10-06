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
                <textarea name="" id="" cols="30" rows="10">{{ $candidate->vision_mission }}</textarea>
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