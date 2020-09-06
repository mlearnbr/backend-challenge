@extends('layouts.app')

@section('content')
    <h1>Usuários</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Novo usuário</a>
    <table class="table">
        <thead>
        <tr>
            <th>Login</th>
            <th>Nome</th>
            <th>Acesso</th>
            <th>Opções</th>
        </tr>
        </thead>
        <tbody>
        @if(count($users) === 0)
            <tr>
                <td colspan="4">Não foram encontrados resultados.</td>
            </tr>
        @endif
        @foreach($users as $user)
            <tr>
                <td>{{ $user->msisdn }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ ucfirst($user->access_level) }}</td>
                <td>
                    <a href="{{ route('users.toggle_access', $user) }}" class="btn @if($user->access_level === 'free') btn-primary @else btn-danger @endif">
                        @if($user->access_level === 'free')
                            Upgrade
                        @else
                            Downgrade
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
