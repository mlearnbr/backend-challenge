@extends('layout.main')
@section('title', 'Usuários')
@push('js')
<script src="js/jquery.mask.js"></script>
<script>
    $(function(){
        $('#msisdn').mask('+9999999999999')
    });
</script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Cadastro de usuários
                </div>
                
                <div class="card-body">
                    <form method="post" action="users">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror" id="name">
                                 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>O campo nome é obrigatório</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="msisdn" class="col-sm-2 col-form-label">Telefone</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('msisdn') }}" name="msisdn" class="form-control @error('msisdn') is-invalid @enderror" data-mask="+9999999999999" id="msisdn">
                                @error('msisdn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>O campo telefone é obrigatório</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="access_level" class="col-sm-2 col-form-label">Nível de acesso</label>
                            <div class="col-sm-10">
                                <select  name="access_level" id="access_level" class="form-control @error('access_level') is-invalid @enderror">
                                    <option value="">Selecione</option>
                                    <option @if(old('access_level') === 'free') selected @endif value="free">Free</option>
                                    <option @if(old('access_level') === 'premium') selected @endif value="premium">Premium</option>
                                </select>
                                @error('access_level')
                                <span class="invalid-feedback" role="alert">
                                        <strong>O campo nível de acesso é obrigatório</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Senha</label>
                            <div class="col-sm-10">
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cadastrar usuário</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
