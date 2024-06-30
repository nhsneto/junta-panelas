<!DOCTYPE html>
<html lang="{{ strtolower(str_replace('_', '-', app()->getLocale())) }}" class="h-full bg-[#fff5ea]">
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
                <div class="flex items-center space-x-6">
                    @guest
                        <x-primary-link href="{{ route('login') }}">{{ __('Log In') }}</x-primary-link>
                        <x-primary-link href="{{ route('register') }}">{{ __('Register') }}</x-primary-link>
                    @endguest

                    @auth
                        <x-primary-link href="{{ route('junta-panelas.index') }}">{{ __('My Junta-Panelas') }}</x-primary-link>

                        <div class="relative">
                            <button id="dropdownTrigger">
                                <x-icons.user-circle class="size-9" />
                            </button>

                            <div id="dropdown" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-[#fbfbfb] py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="{{ route('profile') }}" class="menuItem block px-4 py-2 text-sm text-black/65 hover:bg-black/5" id="user-menu-item-0">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="w-full px-4 py-2 text-left text-sm text-black/65 hover:bg-black/5">{{ __('Log Out') }}</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </nav>

            <main class="@guest mt-auto @endguest flex justify-center">{{ $slot }}</main>

            <footer class="mt-auto py-10 text-sm text-center">
                <p>&copy; nhsneto</p>
            </footer>
        </div>

        <script>
            window.onload = function () {
                const trigger = document.getElementById('dropdownTrigger');
                const dropdown = document.getElementById('dropdown');
                let show = false;

                trigger.addEventListener('click', () => {
                    show = !show;

                    if (show) {
                        dropdown.style.display = "block";
                    } else {
                        dropdown.style.display = "none";
                    }
                });
            }
        </script>
    </body>
</html>
