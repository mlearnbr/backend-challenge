<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>mLearn - Desafio backend</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="min-h-screen bg-gray-100">
  <div class="container">
    @yield('main')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
