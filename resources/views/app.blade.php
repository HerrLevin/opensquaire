<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'OpenSquaire') }}">
        <meta name="apple-mobile-web-app-status-bar-style" content="#272b5c">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" sizes="512x512" href="/img/logo512.png">
        <meta name="theme-color" content="#272b5c">
        <link rel="shortcut icon" sizes="512x512" href="/img/logo512.png">
        <link rel="shortcut icon" sizes="128x128" href="/img/logo128.png">
        <link rel="shortcut icon" sizes="512x512" href="/img/logo512.png">
        <link rel="shortcut icon" sizes="128x128" href="/img/logo128.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="name" content="{{ config('app.name', 'OpenSquaire') }}">

        <title inertia>{{ config('app.name', 'OpenSquaire') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
