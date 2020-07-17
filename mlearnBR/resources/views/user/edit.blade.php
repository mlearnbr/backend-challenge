@extends('layout')

@section('header')
  Adicionar Usuário
@endsection

@section('content')
  
  @include('alerts.messages')
  <form method="post" action="{{route('user.update', $user->id)}}">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col col-8">  
        <label for="name">Nome</label>
        <input type="text" 
               class="form-control mb-3" 
               name="name" 
               value="{{$user->name}}" 
               id="name"
               placeholder="Digite seu nome">        
      </div>

      <div class="col col-8">  
        <label for="msisdn">Telefone</label>
        <input type="text" 
               class="form-control mb-3" 
               name="msisdn" 
               value="{{$user->msisdn}}"
               id="msisdn"
               placeholder="Digite seu Telefone de contato">        
      </div>
      
      <div class="col col-8">          
        <label for="access_level">Tipo de Acesso</label>
        <select name="access_level" 
                class="form-control mb-3">
        @foreach($levels as $l)
          {{$selected = $l == $user->access_level 
            ? 'selected' : ''}}  
          <option value="{{$l}}" <?=$selected?>>{{$l}}
          </option>
        @endforeach  
        </select>
      </div>       
    </div>

    <button class="btn btn-dark mt-1">Atualizar</button>
</form>
<script src="..\js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js">  
</script>
<script>
   $(document).ready(function(){ 
     $("#msisdn").mask("55-99-9999-9999");
});   
</script>



@endsection