@extends('layout/header')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Usuários</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID Externo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Nivel de acesso</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->external_id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->msisdn}}</td>
                            <td>{{$user->access_level}}</td>
                            <td class="text-center">
                                <a type="button" href="/api/upgradeuser/{{$user->external_id}}" class="btn btn-outline-success">Upgrade</a>
                                <a type="button" href="/api/downgradeuser/{{$user->external_id}}" class="btn btn-outline-danger">Downgrade</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

