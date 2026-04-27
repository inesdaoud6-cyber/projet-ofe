<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffing2Earn</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

<nav>
    <a href="{{ route('home') }}" class="nav-brand">
        <img src="{{ asset('images/2earn.png') }}">
    </a>
</nav>

{{ $slot }}

<footer>
    <span>© {{ date('Y') }} Staffing2Earn</span>
</footer>

</body>
</html>