<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffing2Earn — {{ __('Welcome to Staffing2Earn') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

<nav>
    <a href="{{ url('/') }}" class="nav-brand">
        <img src="{{ asset('images/2earn.png') }}" alt="Staffing2Earn">
    </a>

    <ul class="nav-links">
        <li><a href="#avantages">{{ __('About') }}</a></li>
        <li><a href="#how">{{ __('Home') }}</a></li>

        <li class="lang-item">
            <div class="lang-switcher">
                <a href="{{ route('lang.switch', 'fr') }}" class="lang-btn {{ app()->getLocale() === 'fr' ? 'active' : '' }}">FR</a>
                <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">EN</a>
                <a href="{{ route('lang.switch', 'ar') }}" class="lang-btn {{ app()->getLocale() === 'ar' ? 'active' : '' }}">AR</a>
            </div>
        </li>

        <li>
            <a href="{{ route('auth.login') }}" class="btn-nav">
                {{ __('Get Started') }}
            </a>
        </li>
    </ul>
</nav>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="orb-1 hero-orb"></div>
    <div class="orb-2 hero-orb"></div>
    <div class="orb-3 hero-orb"></div>

    <div class="hero-inner">

        <div class="hero-content">
            <div class="hero-badge">
                <span class="badge-dot"></span>
                {{ __('Smart Tests') }}
            </div>

            <h1>
                {{ __('Welcome to Staffing2Earn') }}<br>
                <span class="accent">{{ __('Candidate Management') }}</span>
            </h1>

            <p class="hero-desc">
                {{ __('An intelligent recruitment platform that connects talent with the best opportunities.') }}
            </p>

            <div class="hero-actions">
                <a href="{{ route('auth.login') }}" class="btn-primary">
                    {{ __('Get Started') }}
                </a>

                <a href="#how" class="btn-secondary">
                    {{ __('About') }}
                </a>
            </div>
        </div>

    </div>
</section>

<footer>
    <div class="footer-brand">
        <img src="{{ asset('images/2earn.png') }}" alt="Staffing2Earn">
    </div>

    <span class="footer-copy">© {{ date('Y') }} Staffing2Earn.</span>

    <ul class="footer-links">
        <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
        <li><a href="#avantages">{{ __('About') }}</a></li>
        <li><a href="{{ route('auth.login') }}">{{ __('Login') }}</a></li>
    </ul>
</footer>

</body>
</html>