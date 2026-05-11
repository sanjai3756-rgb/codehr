<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<!-- Login Card -->
<div class="login-card">

    <h1>HRMS</h1>

    <p>Welcome Back</p>

    {{-- Error Message --}}
    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">

        @csrf

        <input
            type="email"
            name="email"
            placeholder="Email"
            value="{{ old('email') }}"
            required
            autocomplete="email"
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            autocomplete="current-password"
        >

        <button type="submit">
            Login
        </button>

    </form>

</div>

<script src="{{ asset('assets/js/login.js') }}"></script>

</body>
</html>