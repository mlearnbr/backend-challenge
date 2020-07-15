<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MLearn Test</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="{{asset('dist/css/app.css')}}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <style>
            .swal2-title, .swal2-content, .swal2-actions{
                font-family: "Roboto", sans-serif;
            }
        </style>
    </head>
    <body>
    <div id="app">
        <app></app>
    </div>
    <script src="{{asset('dist/js/app.js')}}"></script>
    </body>
</html>
