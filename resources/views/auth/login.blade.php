<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Staffing2Earn</title>


    @vite(['resources/css/global.css', 'resources/css/navbar.css'])
    <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #667eea;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #5568d3;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <img src="{{ asset('images/2earn.png') }}" alt="Logo">
            <h2>Staffing2Earn</h2>
        </div>

        <ul class="nav-links">
            <li><a href="/home">Home</a></li>
            <li><a href="/#about">About</a></li>
        </ul>
    </nav>


    <div class="login-container">
        <h2>Login to your account</h2>

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
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="back-link">
            <a href="/">← Back to home</a>
        </div>
    </div>

</body>

</html>