<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaraBookmarks</title>
    @vite('resources/css/app.css')  
</head>
<body class="bg-gray-50 font-sans">
    <header class="bg-white shadow p-4 mb-6">
        <h1 class="text-xl font-bold  text-indigo-600">LaraBookmarks</h1>
    </header>

    <main class="px-4">
        @yield('content')
    </main>
</body>
</html>
