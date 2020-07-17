@extends('layout')

@section('header')
  Consulta Usuário
@endsection

@section('content')
  @if(empty($user['name']))
    <p class="btn btn-warning">
      <b>Nenhum registro foi encontrato</b>      
    </p>
  @else
    <div>
      <a href="{{route('user.index')}}">Menu</a>
    </div> 
     
    <div class="col col-8">  
      <label for="name">Nome:</label>
      <input value="{{mb_strtoupper($user['name'])}}" 
             readonly="true"
             class="form-control mb-3" >  
    </div>

    <div class="col col-8">  
      <label for="msisdn">Telefone:</label>
      <input value="{{$user['msisdn']}}"
             readonly="true" 
             class="form-control mb-3"
             id="msisdn">  
    </div>

    <div class="col col-8">  
      <label for="access_level">Tipo Acesso</label>
      <input value="{{mb_strtoupper($user['access_level'])}}" 
             readonly="true" 
             class="form-control mb-3" >  
    </div>  
  @endif  
@endsection