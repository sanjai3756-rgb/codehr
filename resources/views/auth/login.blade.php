<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>

<div class="login-container">
<div class="login-card">

<h2>HRMS Login</h2>

@if(session('error'))
<p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
@csrf

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<button type="submit">Login</button>

</form>

</div>
</div>

</body>
</html>