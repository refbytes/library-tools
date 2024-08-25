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
        @include('layouts.theme')
        {!! $theme->css ?? '' !!}
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <header>
            @if(! empty($theme->header))
                {!! $theme->header !!}
            @else
                <x-header />
            @endif
        </header>
        <div class="min-h-screen bg-[var(--pageBackgroundColor)] dark:bg-gray-900">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="py-6 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer>
            @if(! empty($theme->footer))
                {!! $theme->footer !!}
            @else
                <x-footer />
            @endif
        </footer>
        @stack('modals')
        @livewireScriptConfig
        {!! $theme->js ?? '' !!}
    </body>
</html>
