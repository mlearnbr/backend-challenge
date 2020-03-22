@extends('layouts.front')

@section('main_content')
        <h1 class="h3 mb-2 text-gray-800">Usuários</h1>
        @include('partials.users.list')
@endsection

@section('footer_scripts')
        <script src="{{asset('js/users/users_manager.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/users/index.js')}}" type="text/javascript"></script>
@endsection
