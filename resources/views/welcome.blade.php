<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staffing2Earn</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar img {
            height: 50px;
        }

        .nav-links a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #6c5ce7;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 50px;
        }

        .hero-text {
            max-width: 500px;
        }

        .hero-text h1 {
            font-size: 40px;
            color: #2d3436;
        }

        .hero-text p {
            color: #636e72;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            background: #6c5ce7;
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }

        .hero img {
            width: 400px;
        }

        .about {
            padding: 80px 50px;
            background: white;
            text-align: center;
        }

        .about h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .about p {
            max-width: 700px;
            margin: auto;
            color: #555;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #2d3436;
            color: white;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <img src="{{ asset('images/2eran.png') }}" alt="Logo">

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#about">About</a>
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

    <section class="hero">
        <div class="hero-text">
            <h1>Welcome to Staffing2Earn</h1>
            <p>
                An intelligent recruitment platform that connects talent with the best opportunities.
            </p>

            <a href="#" class="btn">Get Started</a>
        </div>

        <img src="{{ asset('images/2earn.png') }}" alt="Illustration">
    </section>

    <section id="about" class="about">
        <h2>About the Platform</h2>
        <p>
            Staffing2Earn is an innovative recruitment platform that enables companies to find the best candidates
            and allows applicants to progress through a structured system of tests and levels.
            Our goal is to make the recruitment process smarter, more structured, and more efficient.
        </p>
    </section>

    <footer>
        © {{ date('Y') }} Staffing2Earn - All rights reserved
    </footer>

</body>

</html>