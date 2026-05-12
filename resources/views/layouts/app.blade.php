<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDEConnect</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center">
    <a href="{{ route('calendrier') }}" class="text-xl font-bold">🎓 BDEConnect</a>
    <div class="flex gap-4">
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('evenements.index') }}" class="hover:underline">Événements</a>
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @else
                <a href="{{ route('calendrier') }}" class="hover:underline">Calendrier</a>
                <a href="{{ route('inscriptions.historique') }}" class="hover:underline">Mes inscriptions</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
            <a href="{{ route('register') }}" class="hover:underline">Inscription</a>
        @endauth
    </div>
</nav>
<main class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>