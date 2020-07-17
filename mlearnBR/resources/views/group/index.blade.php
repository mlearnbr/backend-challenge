@extends('layout')

@section('header')
Listagem de Grupos
@endsection

@section('content')

<div class="box-body">    
    @include('alerts.messages')    
    <table class="table table-borderred table-hover table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>GroupId</th>
          <th>Titulo</th> 
          <th>Usuário</th>        
        </tr>  
      </thead>
      <tbody>
        @forelse($groupList as $g)
         <tr>
          <td>{{$g->id}}</td>
          <td>{{$g->group_id}}</td>
          <td>{{$g->title}}</td> 
          <td>{{$g->user->name}}</td>
         </tr>
         @empty
           <p>sem Registro</p>
         @endforelse
      </tbody>
    </table>              
  </div>  
@endsection