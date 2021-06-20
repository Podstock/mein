<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <x-jet-banner />

    <div>

        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="max-w-7xl mx-auto">
            {{ $slot }}
        </main>
    </div>

    <footer>
        <div class="flex justify-center text-sm text-grey mt-16 border-t pt-4" aria-label="version">mein.podstock.de
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


    @stack('modals')

    @livewireScripts
</body>

</html>
