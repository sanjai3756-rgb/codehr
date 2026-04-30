<!DOCTYPE html>
<html>
<head>
    <title>HRMS Login</title>

    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>
<body>

<!-- Animated Background -->
<div class="circles">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<!-- Glass Login Card -->
<div class="login-card">

    <h1>HRMS</h1>
    <p>Welcome Back</p>

    @if(session('error'))
    <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">

        @csrf

        <input type="email" name="email" placeholder="Email Address">

        <div class="password-box">

            <input type="password" name="password" id="password" placeholder="Password">

            <span class="eye" onclick="togglePassword()">👁</span>

        </div>

        <button type="submit">Login</button>

    </form>

</div>

<script src="{{ asset('assets/js/login.js') }}"></script>

</body>
</html>