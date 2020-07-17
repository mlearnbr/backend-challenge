@extends('layout')

@section('header')
  Adicionar Usuário
@endsection

@section('content')
  
  @include('alerts.messages')
  <form method="post" action="{{route('user.store')}}">
    @csrf
    <div class="row">
      <div class="col col-8">  
        <label for="name">Nome</label>
        <input type="text" 
               class="form-control mb-3" 
               name="name" 
               value="{{old('name')}}" 
               id="name"
               placeholder="Digite seu nome">        
      </div>

      <div class="col col-8">  
        <label for="msisdn">Telefone</label>
        <input type="text" 
               class="form-control mb-3" 
               name="msisdn" 
               id="msisdn"
               placeholder="Digite seu Telefone de contato">        
      </div>
      
      <div class="col col-8">          
        <label for="access_level">Tipo de Acesso</label>
        <select name="access_level" class="form-control mb-3">
          <option value="free">Free</option>
          <option value="premium">Premium</option>
        </select>
      </div>

      <div class="col col-8">          
        <label for="password" class="">Senha</label>
        <input type="password" class="form-control" 
               name="password" 
               id="password"
               placeholder="Informe uma senha"
               maxlength="6">
      </div>

      <div class="col col-4">          
        <label for="password_confirmation" 
               >Confirme a Senha</label>
        <input type="password" class="form-control mb-3" 
               name="password_confirmation" 
               id="password_confirmation"
               placeholder="Confirme a senha"
               maxlength="6">
      </div> 
    </div>

    <button class="btn btn-primary mt-1">Adicionar</button>
</form>
@endsection