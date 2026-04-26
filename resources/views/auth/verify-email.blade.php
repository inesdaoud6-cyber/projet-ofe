<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification email - Staffing2Earn</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f0f5e 0%,#1e1ea8 40%,#7c3aed 100%);}
        .card{background:#fff;border-radius:20px;padding:2.5rem;max-width:420px;width:100%;margin:1.5rem;box-shadow:0 25px 60px rgba(0,0,0,0.3);text-align:center;}
        .icon{font-size:3.5rem;margin-bottom:1.25rem;}
        h1{font-size:1.4rem;font-weight:800;color:#0f0f5e;margin-bottom:0.5rem;}
        p{color:#6b7280;font-size:0.9rem;line-height:1.6;margin-bottom:1.5rem;}
        .alert-success{background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:.75rem 1rem;margin-bottom:1.25rem;}
        .alert-success p{color:#16a34a;margin:0;}
        .btn{display:inline-block;padding:.8rem 1.75rem;background:linear-gradient(135deg,#1e1ea8,#7c3aed);color:#fff;border:none;border-radius:10px;font-weight:700;font-size:.9rem;cursor:pointer;text-decoration:none;transition:opacity .2s;width:100%;}
        .btn:hover{opacity:.9;}
        .link{margin-top:1rem;display:block;color:#1e1ea8;font-size:.85rem;text-decoration:none;font-weight:600;}
        .link:hover{color:#7c3aed;}
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">📧</div>
        <h1>Vérifiez votre email</h1>
        <p>Un lien de vérification a été envoyé à votre adresse email. Cliquez sur le lien pour activer votre compte.</p>

        @if (session('success'))
            <div class="alert-success"><p>{{ session('success') }}</p></div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn">Renvoyer le lien de vérification</button>
        </form>

        <form method="POST" action="{{ route('auth.logout') }}" style="margin-top:1rem;">
            @csrf
            <a href="#" onclick="this.closest('form').submit()" class="link">← Se déconnecter</a>
        </form>
    </div>
</body>
</html>