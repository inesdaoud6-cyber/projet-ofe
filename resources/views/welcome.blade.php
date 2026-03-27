<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Staffing2Earn</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">


    <nav class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
            <div class="flex items-center gap-3">
                <img src="{{ Vite::asset('resources/images/logo.png') }}" class="w-32">
                <span class="text-xl font-bold">Staffing2Earn</span>
            </div>

            <div class="space-x-6">
                <a href="{{ route('home') }}" class="hover:text-green-400">Home</a>

                <a href="#about" class="hover:text-green-400">About</a>

                <a href="{{ route('auth.login') }}" class="hover:text-green-400">Login</a>
            </div>
        </div>
    </nav>


    <section class="text-center py-16">
        <h1 class="text-4xl font-bold">
            Welcome to Staffing2Earn
        </h1>

        <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
            An intelligent recruitment platform that connects talent with the best opportunities.
        </p>

        <button class="mt-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow">
            Get Started
        </button>

        <div class="mt-10">
            <img src="{{ Vite::asset('resources/images/logo.png') }}" class="w-72 mx-auto">
        </div>
    </section>

    <section id="about" class="max-w-5xl mx-auto py-12 px-6">
        <h2 class="text-2xl font-bold mb-6">About Staffing2Earn</h2>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold">Smart Tests</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Create and manage multi-level assessment tests.
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold">Candidate Management</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Track candidates throughout recruitment.
                </p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold">Analytics</h3>
                <p class="text-sm text-gray-600 mt-2">
                    Analyze performance and results easily.
                </p>
            </div>
        </div>
    </section>


</body>

</html>