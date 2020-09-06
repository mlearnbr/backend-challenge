@extends('layouts.app')
@section('content')
    <h1>Novo usuário</h1>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="msisdn" class="col-sm-2 col-form-label">Telefone</label>
            <div class="col-sm-4">
                <input type="text" name="msisdn" id="msisdn" value="{{ old('msisdn') }}"
                       class="form-control @error('msisdn') is-invalid @enderror" required>
                <small class="form-text text-muted">O telefone deve estar no formato +5531999999999</small>
            </div>
            @error('msisdn')
            <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-4">
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror" required>
            </div>
            @error('name')
            <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="access_level" class="col-sm-2 col-form-label">Acesso</label>
            <div class="col-sm-4">
                <select name="access_level" id="access_level"
                        class="form-control @error('access_level') is-invalid @enderror" required>
                    @foreach($access_levels as $ac)
                        <option value="{{ $ac }}"
                                @if(old('access_level') === $ac) selected @endif>{{ ucfirst($ac) }}</option>
                    @endforeach
                </select>
            </div>
            @error('access_level')
            <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Senha</label>
            <div class="col-sm-4">
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror" required>
            </div>
            @error('password')
            <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirme a senha</label>
            <div class="col-sm-4">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control @error('password_confirmation') is-invalid @enderror" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
@endsection
