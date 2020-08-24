@extends('layouts.app')
<!-- informando o nome do layout e englobando o nosso template dentro da section -->
@section('content')
    <a href="{{route('users.create')}}" class="btn btn-lg btn-success mb-3">Criar Usuário</a>

    @if(count($users))

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Número</th>
                <th>Nível de acesso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->msisdn}}</td>
                    <td>{{$user->access_level}}</td>
                    <td>
                        <div class="btn-group">

                            <form action="{{route('users.update', ['user' => $user->id])}}" method="post">
                                @csrf
                                @method("PUT")

                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form>

                            <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-sm btn-primary mr-2">EDITAR</a>
        
                            <form action="{{route('users.destroy', ['user' => $user->id])}}" method="post">
                                @csrf
                                @method("DELETE")

                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h3>Nenhum usuário cadastrado no sistema.</h3>
    @endif

{{$users->links()}}
@endsection
