<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="container">
        <h3>Welcome to laravel app</h3>
        <p>You're logged in!</p>
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
        
        {{-- react component --}}
        <div id="example"></div>
    </div>
</x-app-layout>
