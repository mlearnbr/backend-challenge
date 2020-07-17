@extends('layout')

@section('header')
  Adicionar Grupo
@endsection

@section('content')
  
@include('alerts.messages')
  <form method="post" 
        action="{{route('group.store')}}">
    @csrf    
    <input type="hidden" name="user_id"
           value="{{$user_id}}">

    <div class="row">
      <div class="col col-4">  
        <label for="group_id">GroupID</label>
        <input type="text" 
               class="form-control mb-3" 
               name="group_id" 
               value="{{old('group_id')}}" 
               id="group_id"
               placeholder="Digite um código para o grupo"
               maxlength="5">        
      </div>
      <div class="col col-8">  
        <label for="title">Titulo</label>
        <input type="text" 
               class="form-control mb-3" 
               name="title" 
               value="{{old('title')}}" 
               id="title"
               placeholder="Digite um nome para o grupo">        
      </div>      
    </div>
    <button class="btn btn-primary mt-1">Adicionar</button>
</form>
@endsection