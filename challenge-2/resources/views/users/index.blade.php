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
                        <div class="btn-group d-flex justify-content-between">
                            <form action="{{route('users-toggle-plan', ['user' => $user->id])}}" method="post" class="d-flex w-25">
                                @csrf
                                <input type="text" name="id" value="{{$user->id}}" hidden>
                                @if ($user->access_level === 'free')
                                    <button type="submit" class="btn btn-sm btn-warning p-2 flex-grow-1">UPGRADE</button>    
                                @else
                                    <button type="submit" class="btn btn-sm btn-warning p-2 flex-grow-1 flex-shrink-2">DOWNGRADE</button>    
                                @endif
                            </form>

                            <a href="{{route('users.edit', ['user' => $user->id])}}" class="btn btn-sm btn-primary rounded p-2 mx-2 w-25">EDITAR</a>
        
                            <form action="{{route('users.destroy', ['user' => $user->id])}}" method="post" class="d-flex w-25">
                                @csrf
                                @method("DELETE")

                                <button type="submit" class="btn btn-sm btn-danger p-2 flex-grow-1">REMOVER</button>
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
