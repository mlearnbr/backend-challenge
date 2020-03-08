<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio Back-End @mLearn</title>
    <link rel="shortcut icon" href="https://mlearn.com.br/wp-content/uploads/2019/03/favicon-02.png"
        type="image/x-icon">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ url ('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url ('js/bootstrap.min.js') }}"></script>
    <script src="{{ url ('js/vue.js') }}"></script>
    <script src="{{ url ('js/axios.js') }}"></script>
    <script src="{{ url ('js/app.js') }}"></script>
    <script src="{{ url ('js/bootbox.min.js') }}"></script>
</body>

</html>