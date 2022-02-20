@extends('layouts.app')
@section('content')
    <h1 class="text-center">Usuários</h1>
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
                        <form action="{{route('user.index')}}" method="post"
                              class="d-inline">
                            @csrf
                            <button class="btn btn-primary btn-sm col-4" type="submit">Upgrade</button>
                        </form>
                        <form action="{{route('user.index')}}" method="post"
                              class="d-inline">
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
