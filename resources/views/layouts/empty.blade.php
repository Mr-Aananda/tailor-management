<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Include head --}}
        @include('layouts.partials.head')
    </head>

    <body>
        <div id="app">
            <!-- Page Content -->
            {{ $slot }}

        </div>

        <!-- add javascript -->
        @stack('script')
    </body>
</html>
