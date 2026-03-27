<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Login') }} - Staffing2Earn</title>


    @vite(['resources/css/global.css', 'resources/css/navbar.css', 'resources/css/auth/login.css'])
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo">
            <h2>Staffing2Earn</h2>
        </div>

        <ul class="nav-links">
            <li><a href="/home">{{ __('Home') }}</a></li>
            <li><a href="/#about">{{ __('About') }}</a></li>
        </ul>
    </nav>


    <div class="login-container">
        <h2>{{ __('Login to your account') }}</h2>

        @if ($errors->any())
            <div style="padding: 1rem; background: #ffe0e0; border-radius: 4px; margin-bottom: 1rem;">
                @foreach ($errors->all() as $error)
                    <p style="color: #d32f2f; margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login.post') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email Address') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">{{ __('Login') }}</button>
        </form>

        <div class="back-link">
            <a href="/">← {{ __('Back to home') }}</a>
        </div>
    </div>

</body>

</html>