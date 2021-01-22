@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista dos usuários </div>

                <div class="card-body table-striped">
                    <a class='btn btn-primary' href="{{ url('users/create') }}">
                        <i class="fa fa-add" aria-hidden="true"></i> Adicionar novo usuário
                    </a>
                    <p>
                    <div class="table-responsive">
                        <table class="table">
                          <thead class="">
                              <th class="text-center">#</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Fone (msisdn)</th>
                            <th class="text-center">Nível de acesso</th>
                            <th class="text-right">Ação</th>
                          </thead>
                          <tbody>
                              @foreach($users as $user)
                                  <tr>
                                      <td class="text-center">{{ $user->id }}</td>
                                      <td class="text-center">{{ $user->name }}</td>
                                      <td class="text-center">{{ $user->msisdn }}</td>
                                      <td class="text-center">{{ $user->access_level }}</td>
                                        <td class="td-actions text-right">
                                        @if ($user->access_level == 'free')
                                            <a title="Upgrade" href="{{ url("users/{$user->id}/upgrade") }}" class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-upload" aria-hidden="true"></i></a>                                          
                                        @else
                                            <a title="Downgrade " href="{{ url("users/{$user->id}/downgrade") }}" class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-download" aria-hidden="true"></i></a>                                          
                                        @endif
                                        </td>
                                  </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>                                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
