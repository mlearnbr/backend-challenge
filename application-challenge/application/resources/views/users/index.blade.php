@extends('layout.main')
@section('title', 'Usuários')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                  <span class="font-weight-bolder pt-2">
                    Usuários
                  </span>
                  <span class="float-right">
                    <a href="users/create" class="btn btn-primary text-white" target="_BLANK">
                      Cadastrar novo usuário
                    </a>
                  </span>
                </div>
                <div class="card-body">
                    <form class="form-inline row mb-5 justify-content-center mt-3" action="">
                        <div class="form-group col-9">
                          <input type="text" class="form-control w-100" id="name" name="name" placeholder="Digite aqui o nome do usuário">
                        </div>
                        <button type="submit" class="btn btn-primary col-1">Buscar</button>
                    </form>

                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Nível de acesso</th>
                            <th scope="col">Opções</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                            <tr>
                                <th scope="row">{{ $row->id }}</th>
                                <td>{{ $row->msisdn }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->access_level }}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($row->access_level === 'free')
                                        <form action="{{ route('users.upgrade', $row->id) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button class="btn btn-success">
                                            Upgrade 
                                          </button>
                                        </form>
                                        @else
                                        <form action="{{ route('users.downgrade', $row->id) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <button class="btn btn-danger">
                                            Downgrade 
                                          </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                      </table>

                      {{ $users->withQueryString()->links() }}
                
                </div>
              </div>

            </div>
    </div>
</div>
@endsection
