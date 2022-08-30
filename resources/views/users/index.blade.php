@extends('layouts.app')
@section('content')
    <div class="row">
        <h1 class="col-11 text-center">Usuários</h1>
        <div class="col-1">
            <a class="btn btn-primary" href="{{route("user.create")}}">
                Adicionar
            </a>
        </div>
    </div>
    <table class="table table-dark">
        <thead>
        <tr class="text-center">
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Level</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="text-center">
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->msisdn}}</td>
                    <td>{{$user->access_level}}</td>
                    <td>
                        <form action="{{route('upgrade', [$user->id])}}" method="POST"
                              class="d-inline">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary btn-sm col-4" type="submit">Upgrade</button>
                        </form>
                        <form action="{{route('downgrade', [$user->id])}}" method="POST"
                              class="d-inline">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-danger btn-sm col-4" type="submit">Downgrade</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Sem registros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
