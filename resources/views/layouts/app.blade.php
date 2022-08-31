<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Include head --}}
        @include('layouts.partials.head')
    </head>

    <body>
        <div id="app">
            {{-- include sidebar --}}
            @include('layouts.partials.sidebar')

            <div class="mainbar">
                {{-- include top navigation --}}
                @include('layouts.navigation')

                {{-- message handler area --}}
                <div class="container mb-3">
                    @if(session()->has('success'))
                        <x-alert-component :messages="session()->get('success')"/>
                    @else
                        @if ($errors->any())
                            <x-alert-component type="danger" :messages="$errors->all()"/>
                        @endif
                    @endif
                </div>

                <!-- Page Content -->
                {{ $slot }}
            </div>
        </div>

        <!-- javascript stack -->
        @include('layouts.partials.scripts')
    </body>
</html>
