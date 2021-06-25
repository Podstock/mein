<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100">
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <footer>
        <div class="flex justify-center text-sm text-grey mt-16 border-t pt-4" aria-label="version" x-data="app">
            mein.podstock.de v<span x-html="version"></span>
        </div>
        <div class="flex justify-center text-sm text-grey mt-2">
            <a class="no-underline text-grey-darker hover:underline px-1"
                href="https://www.podstock.de/code_of_conduct.html" target="_blank" rel="noopener">Verhaltenskodex</a><span
                aria-hidden="true"> | </span>
            <a class="no-underline text-grey-darker hover:underline px-1"
                href="https://www.podstock.de/datenschutz.html" target="_blank" rel="noopener">Datenschutz</a><span
                aria-hidden="true"> | </span>
            <a class="no-underline text-grey-darker hover:underline px-1" href="https://www.podstock.de/impressum.html"
                target="_blank" rel="noopener">Impressum</a>
        </div>
    </footer>

</body>

</html>
