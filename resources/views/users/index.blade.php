@extends('base')

@section('main')

    <h1 class="display-3">Lista de usuários</h1>

    @if (session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
    @endif

    <div>
      <a style="margin: 19px;" href="{{ route('users.create') }}" class="btn btn-primary">Novo usuário</a>
    </div>

    @if (count($users) > 0)

    <table class="table table-striped">
      <thead>
        <tr>
          <td>Telefone (login)</td>
          <td>Nome</td>
          <td>Nível de acesso</td>
          <td>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{ $user->msisdn }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->access_level }}</td>
          <td>
          @if($user->access_level === 'free')
            <form method="post" action="{{ route('users.upgrade', $user->id) }}">
              @csrf
              @method('PUT')
              <button class="btn btn-success" type="submit">Upgrade</button>
            </form>
          @else
           <form method="post" action="{{ route('users.downgrade', $user->id) }}">
              @csrf
              @method('PUT')
              <button class="btn btn-warning" type="submit">Downgrade</button>
            </form>
          @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="d-flex justify-content-center">
      {{ $users->links() }}
    </div>

    @else
        <div class="alert alert-info">Nenhum usuário cadastrado.</div>
    @endif

@endsection
