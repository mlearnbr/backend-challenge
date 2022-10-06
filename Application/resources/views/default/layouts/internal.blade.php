<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{config('app.name')}} | {{  $title ?? config('app.name') }}</title>
    <meta charset="utf-8">
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">
    <main class="content-wrapper" style="padding-bottom: 30px !important;">
        <section class="content-header">
            <h1>
                {{ $title ?? '' }}
                <small>{{ $subtitle ?? '' }}</small>
            </h1>
            @yield('breadcrumb')
            @isset($contextTitle)
                <h4>{!! $contextTitle !!}</h4>
            @endisset
        </section>
        <section class="content">
            @yield('content')
        </section>
    </main>
    @include('default.partials._message')
</div>
@vite('resources/js/app.js')
@yield('page_js')
</body>
</html>
