<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-[#fff5ea]">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Junta-Panelas App</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Style+Script&display=swap" rel="stylesheet">
        @vite('resources/js/app.js')
    </head>
    <body class="h-full text-black/65">
        <div class="max-w-screen-xl h-full m-auto flex flex-col px-5">
            <nav class="flex justify-between items-center py-10 font-semibold">
                <a href="{{ url('/') }}" class="font-['Style_Script'] text-5xl">Junta-Panelas</a>
                <div class="space-x-6">
                    @guest
                        <x-primary-link href="{{ route('login') }}">Entrar</x-primary-link>
                        <x-primary-link href="{{ route('register') }}">Cadastro</x-primary-link>
                    @endguest

                    @auth
                        <x-primary-link href="{{ route('dashboard') }}">Meus Junta-Panelas</x-primary-link>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @method('DELETE')
                            @csrf
                            <button>Log Out</button>
                        </form>
                    @endauth
                </div>
            </nav>

            <main class="@guest mt-auto @endguest flex justify-center">{{ $slot }}</main>

            <footer class="mt-auto py-10 text-sm text-center">
                <p>&copy; nhsneto</p>
            </footer>
        </div>
    </body>
</html>
