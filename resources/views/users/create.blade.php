@extends('base')

@section('main')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Adicionar usuário</h1>
    <div>
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br>
      @endif
      <form method="post" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group">
          <label for="msisdn">Telefone (login) *</label>
          <input type="text" id="msisdn" name="msisdn" class="form-control" value="{{ old('msisdn') }}">
        </div>

        <div class="form-group">
          <label for="name">Nome *</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
          <label for="access_level">Nível de acesso *</label>
          <select class="form-control" id="access_level" name="access_level">
            @foreach($access_levels as $level => $level_label)
              <option value="{{ $level }}">{{ $level_label }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" id="password" name="password" class="form-control">
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirmação da senha</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary" role="button">Cancelar</a>

      </form>
    </div>
  </div>
</div>
@endsection
