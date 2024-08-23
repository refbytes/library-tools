<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $site->name ?? config('app.name', 'Laravel') }}</title>
        {!! $site->meta ?? '' !!}
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {!! $site->css ?? '' !!}
    </head>
    <body>
        <header>
            @if(! empty($site->header))
                {!! $site->header !!}
            @else
                <x-header />
            @endif
        </header>
        <div id="main">
            {{ $slot }}
        </div>
        <footer>
            @if(! empty($site->footer))
                {!! $site->footer !!}
            @else
                <x-footer />
            @endif
        </footer>
        {!! $site->js ?? '' !!}
    </body>
</html>
