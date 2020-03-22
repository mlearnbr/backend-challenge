@extends('layouts.app')
@section('content')
<!-- Main Content -->
<div id="content">
    @include('partials.topbar')

     <!-- Begin Page Content -->
    <div class="container-fluid">
        @yield('main_content')
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
@endsection