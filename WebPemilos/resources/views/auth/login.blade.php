@section('title', 'Login')

@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login.submit') }}">
    @csrf
    Nisn: <input type="text" name="nisn" required><br>
    Token: <input type="text" name="token" required><br>
    <button type="submit">Login</button>
</form>
@if($errors->any()) <p style="color:red">{{ $errors->first() }}</p> @endif
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif
@if(session('success'))
   <p> ("{{ session('success') }}")</p>
@endif
@if($errors->any())
<script>
    alert("{{ $errors->first() }}");
</script>
@endif