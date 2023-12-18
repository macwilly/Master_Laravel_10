<!DOCTYPE html>
<html lang="">
    <head>
        <title>Laravel 10 List App</title>
        <script src="https://cdn.tailwindcss.com"></script>

        @yield('styles')
    </head>
    <body class="container mx-auto mt-10 mb-10 max-w-lg">
        <h1 class="mb-4 text-2xl">@yield('title')</h1>
        <div>
            {{-- Checking to see is the session has the success field  --}}
            @if(session()->has('success'))
                {{-- Desiplaying the session['success'] message that was set when data was inserted into the database --}}
                <div>{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>
    </body>
</html>
