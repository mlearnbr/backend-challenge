@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Usuários') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (isset($users))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Nível</th>
                                    <th class="text-center" scope="col" style="width:150px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users as $user )
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->msisdn }}</td>
                                        <td>{{ $user->access_level }}</td>
                                        <td class="text-center">
                                            <a class="p-2" href="{{ route('users.downgrade', ['id' => $user->id]) }}" title="Downgrade"><i class="fa fa-download"></i></a> 
                                            |
                                            <a class="p-2" href="{{ route('users.upgrade', ['id' => $user->id]) }}" title="Upgrade"><i class="fa fa-upload"></i></a>
                                            | 
                                            <a class="p-2" href="{{ route('users.delete', ['id' => $user->id]) }}" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
