<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <base href="{{ url('/') }}" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>mLearn - @yield('title')</title>
        <link href="img/favicon-02.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="css/app.css">
        <script src="js/app.js"></script>
        @stack('js')
        @stack('css')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-info bg-info justify-content-center mb-5">
            <a class="navbar-brand" href="#">
                <img src="/img/img-marca-azul.svg" width="80" height="80" alt="" loading="lazy">
            </a>
        </nav>
        @yield('content')
    </body>
</html>
