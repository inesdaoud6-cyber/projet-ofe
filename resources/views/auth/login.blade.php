<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - Staffing2Earn</title>
    @vite(['resources/css/global.css', 'resources/css/navbar.css', 'resources/css/auth/login.css'])
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/2earn.png') }}" alt="Logo">
            <h2>Staffing2Earn</h2>
        </div>
        <ul class="nav-links">
            <li><a href="/">{{ __('Home') }}</a></li>
            <li><a href="/#about">{{ __('About') }}</a></li>
            <li>
                <div style="display:flex;align-items:center;gap:4px;">
                    <a href="{{ route('lang.switch', 'fr') }}"
                        style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale() === 'fr' ? '#1a1a8c' : '#d1d5db' }};background:{{ app()->getLocale() === 'fr' ? '#1a1a8c' : 'transparent' }};color:{{ app()->getLocale() === 'fr' ? '#fff' : '#6b7280' }};">FR</a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale() === 'en' ? '#1a1a8c' : '#d1d5db' }};background:{{ app()->getLocale() === 'en' ? '#1a1a8c' : 'transparent' }};color:{{ app()->getLocale() === 'en' ? '#fff' : '#6b7280' }};">EN</a>
                    <a href="{{ route('lang.switch', 'ar') }}"
                        style="padding:2px 8px;border-radius:5px;font-size:0.75rem;font-weight:700;text-decoration:none;border:1.5px solid {{ app()->getLocale() === 'ar' ? '#1a1a8c' : '#d1d5db' }};background:{{ app()->getLocale() === 'ar' ? '#1a1a8c' : 'transparent' }};color:{{ app()->getLocale() === 'ar' ? '#fff' : '#6b7280' }};">AR</a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="login-page-wrapper">
        <div class="login-container">

            <h2>{{ __('Welcome back') }}</h2>
            <p class="login-subtitle">{{ __('Sign in to your account to continue') }}</p>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login.post') }}">
                @csrf

                <div class="form-section">
                    <div class="section-title">{{ __('Your Credentials') }}</div>

                    <div class="form-group">
                        <label for="email">{{ __('Email') }} <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="votre@email.com">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Password') }} <span class="required">*</span></label>
                        <div class="input-password">
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="toggle-password"
                                onclick="togglePassword('password')">👁</button>
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group remember-row">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Remember me') }}</label>
                    </div>
                </div>

                <button type="submit" class="btn-login">{{ __('Sign in') }} →</button>
            </form>

            <div class="back-link">
                {{ __("Already have an account?") }}
                <a href="{{ route('auth.register') }}">{{ __('Register') }}</a>
                <div class="login-sep"><span>ou</span></div>
                <a href="/">← {{ __('Back to home') }}</a>
            </div>

        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>

</html>