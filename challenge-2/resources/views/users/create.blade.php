@extends('layouts.app')


@section('content')
    <h1>Criar Usuário</h1>
    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nome Usuário *</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Número de telefone *</label>
            <input type="text" name="msisdn" class="form-control @error('msisdn') is-invalid @enderror" value="{{old('msisdn')}}">

            @error('msisdn')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="text" name="password" class="form-control @error('password') is-invalid @enderror" value="{{old('password')}}">

            @error('password')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Nível de acesso *</label>

            <select name="access_level" class="form-control">
              <option value="" @if(old('access_level') === '' || old('access_level') === null) selected @endif ></option>
              <option value="premium" @if(old('access_level') === 'premium') selected @endif >Premium</option>
              <option value="free" @if(old('access_level') === 'free') selected @endif >Free</option>
            </select>

            @error('access_level')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Criar Usuário</button>
        </div>
    </form>
@endsection