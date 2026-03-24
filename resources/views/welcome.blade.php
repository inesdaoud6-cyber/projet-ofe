<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffing2Earn - Recruitment Platform</title>

    @vite([
        'resources/css/global.css',
        'resources/css/navbar.css',
        'resources/css/hero.css',
        'resources/css/about.css',
        'resources/css/footer.css'
    ])
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/2earn.png') }}" alt="Logo">
            <h2>Staffing2Earn</h2>
        </div>

        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-text">
            <h1>Welcome to Staffing2Earn</h1>
            <p>
                An intelligent recruitment platform that connects talent with the best opportunities.
                Streamline your hiring process and find the perfect candidates.
            </p>
            <a href="{{ route('login') }}" class="btn">Get Started</a>
        </div>
        <img src="{{ asset('images/2earn.png') }}" alt="Illustration">
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <h2>About Staffing2Earn</h2>
        <p>
            We provide a comprehensive platform for modern recruitment, featuring intelligent testing,
            candidate evaluation, and seamless application management.
        </p>

        <div class="features">
            <div class="feature">
                <h3>📝 Smart Tests</h3>
                <p>Create and manage multi-level assessment tests for better candidate evaluation.</p>
            </div>
            <div class="feature">
                <h3>👥 Candidate Management</h3>
                <p>Organize and track candidates throughout the recruitment process.</p>
            </div>
            <div class="feature">
                <h3>📊 Analytics</h3>
                <p>Get detailed insights into candidate performance and recruitment metrics.</p>
            </div>
            <div class="feature">
                <h3>🚀 Easy Integration</h3>
                <p>Seamless integration with your existing recruitment workflows.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Staffing2Earn. All rights reserved.</p>
    </footer>
</body>

</html>