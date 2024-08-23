<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $site->name ?? config('app.name', 'Laravel') }}</title>
        {!! $site->meta ?? '' !!}
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {!! $site->css ?? '' !!}
        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <header>
            @if(! empty($site->header))
                {!! $site->header !!}
            @else
                <x-header />
            @endif
        </header>
        <div class="font-sans antialiased text-gray-900 dark:text-gray-100">
            {{ $slot }}
        </div>
        <footer>
            @if(! empty($site->footer))
                {!! $site->footer !!}
            @else
                <x-footer />
            @endif
        </footer>
        @livewireScripts
        {!! $site->js ?? '' !!}
    </body>
</html>
