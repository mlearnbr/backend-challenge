@extends('layouts.app')


@section('content')
    <h1>Editar Usuário</h1>
    <form action="{{route('users.update', ['user' => $user->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Usuário *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $user->name)}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Número de telefone *</label>
            <input type="text" name="msisdn" class="form-control @error('msisdn') is-invalid @enderror" value="{{old('msisdn', $user->msisdn)}}">

            @error('msisdn')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password', $user->password)}}">

            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nível de acesso *</label>

            <select name="access_level" class="form-control">
              <option value="" @if(old('access_level', $user->access_level) === '' || old('access_level', $user->access_level) === null) selected @endif ></option>
              <option value="premium" @if(old('access_level', $user->access_level) === 'premium') selected @endif >Premium</option>
              <option value="free" @if(old('access_level', $user->access_level) === 'free') selected @endif >Free</option>
            </select>

            @error('access_level')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Editar Usuário</button>
        </div>
    </form>
@endsection