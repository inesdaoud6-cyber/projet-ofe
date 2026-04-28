<!DOCTYPE html>
<<<<<<< HEAD
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - Staffing2Earn</title>
    @vite(['resources/css/global.css', 'resources/css/navbar.css', 'resources/css/auth/login.css'])
=======
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Staffing2Earn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/auth/login.css'])
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
</head>

<body>

<<<<<<< HEAD
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
=======
    <div class="page">

        <a href="{{ url('/') }}" class="back-home">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7" />
            </svg>
            Retour à l'accueil
        </a>

        <div class="card">

            <div class="panel" id="panel-c">

                <span class="role-pill candidate">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                        <circle cx="12" cy="7" r="4" />
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    </svg>
                    Candidat
                </span>

                <h1 class="panel-title">Bon retour 👋</h1>
                <p class="panel-sub">Connectez-vous à votre espace candidat</p>

                @if ($errors->any() && session('login_type') !== 'admin')
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="candidate" />

                    <div class="field">
                        <label for="email_c">Email <span class="req">*</span></label>
                        <input type="email" id="email_c" name="email" placeholder="votre@email.com"
                            value="{{ old('email') }}" required autocomplete="email" />
                    </div>

                    <div class="field">
                        <label for="password_c">Mot de passe <span class="req">*</span></label>
                        <div class="input-wrap">
                            <input type="password" id="password_c" name="password" placeholder="••••••••" required
                                autocomplete="current-password" />
                            <button type="button" class="eye" onclick="togglePass('password_c')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <label class="remember">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                            Se souvenir de moi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot">Mot de passe oublié ?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn primary">Se connecter →</button>
                </form>

                <div class="sep"><span>Nouveau sur Staffing2Earn ?</span></div>
                <div class="register-link">
                    <a href="{{ route('register') }}">Créer un compte candidat</a>
                </div>
            </div>

            <div class="admin-link-wrap" id="admin-link-wrap">
                <a href="#" class="admin-link" onclick="showAdmin(); return false;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Accès administrateur
                </a>
            </div>

            <div class="panel hidden" id="panel-a">

                <span class="role-pill admin">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Administrateur
                </span>

                <h1 class="panel-title">Accès Sécurisé 🔐</h1>
                <p class="panel-sub">Réservé au personnel autorisé uniquement</p>

                <div class="admin-notice">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Cet espace est réservé aux administrateurs. Tout accès non autorisé sera signalé.
                </div>

                @if ($errors->any() && session('login_type') === 'admin')
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="admin" />

                    <div class="field">
                        <label for="email_a">Identifiant admin <span class="req">*</span></label>
                        <input type="email" id="email_a" name="email" placeholder="admin@staffing2earn.com"
                            value="{{ old('email') }}" required autocomplete="email" />
                    </div>

                    <div class="field">
                        <label for="password_a">Mot de passe <span class="req">*</span></label>
                        <div class="input-wrap">
                            <input type="password" id="password_a" name="password" placeholder="••••••••" required
                                autocomplete="current-password" />
                            <button type="button" class="eye" onclick="togglePass('password_a')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <label class="remember">
                            <input type="checkbox" name="remember" />
                            Rester connecté
                        </label>
                        <a href="#" class="forgot">Aide connexion</a>
                    </div>

                    <button type="submit" class="btn admin-primary">Accéder au tableau de bord →</button>
                </form>

                <div class="back-candidate-wrap">
                    <a href="#" class="back-candidate" onclick="showCandidate(); return false;">
                        ← Retour à l'espace candidat
                    </a>
                </div>
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
            </div>

        </div>
    </div>

    <script>
<<<<<<< HEAD
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
=======
        function showAdmin() {
            document.getElementById('panel-c').classList.add('hidden');
            document.getElementById('admin-link-wrap').classList.add('hidden');
            document.getElementById('panel-a').classList.remove('hidden');
        }

        function showCandidate() {
            document.getElementById('panel-a').classList.add('hidden');
            document.getElementById('panel-c').classList.remove('hidden');
            document.getElementById('admin-link-wrap').classList.remove('hidden');
        }

        function togglePass(id) {
            const el = document.getElementById(id);
            el.type = el.type === 'password' ? 'text' : 'password';
        }

        @if ($errors->any() && session('login_type') === 'admin')
            showAdmin();
        @endif
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
    </script>

</body>

</html>