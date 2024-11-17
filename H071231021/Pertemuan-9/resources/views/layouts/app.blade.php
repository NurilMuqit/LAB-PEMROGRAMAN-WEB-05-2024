<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory Management')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar Component -->
        @include('components.navbar')
        
        <!-- Main Content -->
        <main class="flex-1 container mx-auto px-4 py-8">
            @include('components.alert')
            @yield('content')
        </main>
    </div>
</body>
</html>
