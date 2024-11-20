<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        @if(auth()->check())
            <!-- Navbar -->
            <nav class="bg-white shadow-lg">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="/" class="text-xl font-semibold">{{ config('app.name') }}</a>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-4">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800">Çıkış Yap</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        @endif

        <!-- Ana İçerik -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>