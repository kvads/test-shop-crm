<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    @include('includes.head')
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 flex items-center flex-col">
    <header>
        @include('includes.header')
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
