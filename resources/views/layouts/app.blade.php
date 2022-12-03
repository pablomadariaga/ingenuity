<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
        @yield('title') - {{ config('app.name') }}
        @else
        {{ config('app.name') }}
        @endif
    </title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="/favicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ded">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:300,400,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/css/styles.css', 'resources/js/app.js'])
</head>

<body @guest class="guest" @endguest>
    <div id="app">
        <x-navbar />
        <main class="@guest py-4 vh-100 @else pt-11 pb-4 @endguest">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/utils.js') }}"></script>
</body>

</html>
