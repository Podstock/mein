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

    <!-- PWA -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=yyL6zP5339">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=yyL6zP5339">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=yyL6zP5339">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=yyL6zP5339" color="#81a540">
    <link rel="shortcut icon" href="/favicon.ico?v=yyL6zP5339">
    <meta name="apple-mobile-web-app-title" content="Mein Podstock">
    <meta name="application-name" content="Mein Podstock">
    <meta name="msapplication-TileColor" content="#81a540">
    <meta name="theme-color" content="#ffffff">
</head>

<body class="bg-gray-100">
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
