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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:300,400,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/css/styles.css', 'resources/js/app.js'])
</head>

<body @guest
    class="guest"
@endguest>
    <div id="app">
        <x-navbar />
        <main class="@guest py-4 @else pt-11 pb-4 @endguest vh-100">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/utils.js') }}"></script>
</body>

</html>
