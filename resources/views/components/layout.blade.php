<!DOCTYPE html>
<html lang="{{ strtolower(str_replace('_', '-', app()->getLocale())) }}" class="h-full bg-[#fff5ea]" data-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Junta-Panelas App</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Style+Script&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

                        <div class="flex dropdown dropdown-bottom dropdown-end">
                            <button id="dropdownTrigger">
                                <x-icons.user-circle class="size-9" />
                            </button>
                            <div tabindex="0" id="dropdownMenu" class="w-48 px-0 py-1.5 dropdown-content menu bg-[#fbfbfb] rounded z-[1] shadow">
                                <a href="{{ route('profile') }}" class="px-4 py-2 hover:bg-black/5">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="w-full text-left px-4 py-2 hover:bg-black/5">{{ __('Log Out') }}</button>
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
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
        </script>
    </body>
</html>
