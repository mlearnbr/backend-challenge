@extends('base')

@section('main')

    <h1 class="display-3">Lista de usuários</h1>

    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
    @endif

    <div>
      <a style="margin: 19px;" href="{{ route('users.create') }}" class="btn btn-primary">Novo usuário</a>
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <td>Telefone (login)</td>
          <td>Nome</td>
          <td>Nível de acesso</td>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->msisdn }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->access_level }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="d-flex justify-content-center">
      {{ $users->links() }}
    </div>

@endsection
