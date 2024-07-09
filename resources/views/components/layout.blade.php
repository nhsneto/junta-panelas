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
            <x-navbar />

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
