<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Desafio 02 - Back-end mLearn</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendors/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/theme/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bootstrap-tables/boostrap-tables.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/parsleyjs/parsley.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Navigation -->
    @include('partials.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        @include('partials.messages')
        @include('partials.modals')

        @yield('content')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{asset('assets/vendors/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap-tables/boostrap-tables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap-tables/bootstrap-table-pt-BR.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-easing/jquery.easing.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-forms/jquery.form.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/parsleyjs/parsley.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/parsleyjs/pt-br.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-mask/jquery.mask.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/theme/js/scripts.bundle.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" type="text/javascript"></script>
<script src="{{asset('js/common/common.js')}}" type="text/javascript"></script>
<script src="{{asset('js/common/jquery.config.js')}}" type="text/javascript"></script>

@yield('footer_scripts')
@stack('scripts')
</body>
</html>
