<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #4F46E5, #9333EA);
        }
    </style>
</head>
<body class="font-sans antialiased gradient-bg text-white">

    <div class="flex flex-col items-center justify-center min-h-screen px-6">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('storage/' . $settings['app_logo']) }}" alt="{{ $settings['app_name'] }}" class="h-10 w-auto">
            <h1 class="text-4xl font-bold">Task Manager</h1>
        </div>

        <!-- Descripción -->
        <p class="mt-4 text-lg text-gray-200 text-center max-w-md">
            Organiza tus tareas, colabora con tu equipo y mejora la productividad.
        </p>

        <!-- Acciones -->
        <div class="mt-6 flex space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-6 py-3 text-lg font-semibold bg-white text-indigo-600 rounded-lg shadow-md hover:bg-gray-200 transition">
                    Ir al Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-3 text-lg font-semibold bg-indigo-500 rounded-lg shadow-md hover:bg-indigo-600 transition">
                    Iniciar Sesión
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-6 py-3 text-lg font-semibold bg-purple-500 rounded-lg shadow-md hover:bg-purple-600 transition">
                        Registrarse
                    </a>
                @endif
            @endauth
        </div>
    </div>

</body>
</html>
