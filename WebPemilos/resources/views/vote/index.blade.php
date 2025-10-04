@section('title','Vote')
@section('content')
<h1>Voting Pemilos</h1>
@if(session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
@if($errors->any())
<p style="color:red;">{{ $errors->first() }}</p>
@endif
@if($hasVoted)
<p>Anda sudah melakukan voting. Terima kasih!</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
@else
@if($user->expires_at)
<p id="countdown"></p>
<script>
    // Hitung mundur (JS countdown + auto redirect)
    let expireTime = new Date("{{ $user->expires_at}}").getTime();
    let interval = setInterval(function() {
        let now = new Date().getTime();
        let distance = expireTime - now;

        if (distance <= 0) {
            clearInterval(interval);
            alert("Waktu login sudah habis!");
            window.location.href = "{{ route('login') }}";
        } else {
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML =
                "Sisa waktu Voting: " + minutes + " menit " + seconds + " detik";
        }
    }, 1000);
</script>
@endif

@foreach($candidates as $candidate)
<div style="margin-bottom:20px;">
    <img src="{{ asset('storage/' . $candidate->candidate_photo) }}"
        alt="{{ $candidate->leader_name }}" width="150"><br>

    <p><b>{{ $candidate->leader_name }} & {{ $candidate->coleader_name }}</b></p>
    <p><b> Visi & Misi:</b></p> <textarea>{{ $candidate->vision_mission }}</textarea>

    <form method="POST" action="{{ route('vote.store') }}">
        @csrf
        <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
        <button type="submit">Vote</button>
    </form>
</div>
<hr>
@endforeach
@endif