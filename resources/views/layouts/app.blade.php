<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Accueil')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav style="background:#f8f9fa;padding:1rem;">
        <a href="/" style="margin-right:1rem;">Accueil</a>
        <a href="/login" style="margin-right:1rem;">Connexion</a>
        <a href="/register">Inscription</a>
    </nav>
    <main style="padding:2rem;">
        @yield('content')
    </main>
</body>
</html>
