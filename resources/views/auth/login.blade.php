<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Staffing2Earn</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">

<body>

    <div class="page">

        {{-- FLÈCHE RETOUR ACCUEIL --}}
        <a href="{{ url('/') }}" class="back-home">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 5l-7 7 7 7" />
            </svg>
            Retour à l'accueil
        </a>

        <div class="card">

            {{-- ========== ESPACE CANDIDAT ========== --}}
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

            {{-- Lien discret vers espace admin --}}
            <div class="admin-link-wrap" id="admin-link-wrap">
                <a href="#" class="admin-link" onclick="showAdmin(); return false;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Accès administrateur
                </a>
            </div>

            {{-- ========== ESPACE ADMIN ========== --}}
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
            </div>

        </div>{{-- .card --}}
    </div>{{-- .page --}}

    <script>
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

        // Si erreur côté admin, ouvrir directement le panel admin
        @if ($errors->any() && session('login_type') === 'admin')
            showAdmin();
        @endif
    </script>

</body>

</html>