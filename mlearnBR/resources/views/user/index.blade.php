@extends('layout')

@section('header')
Listagem de Usuarios
@endsection

@section('content')

<div class="box-body">  
  <div>
    <a href="{{route('user.create')}}">Cadastro</a>
  </div> 
    @include('alerts.messages')
    <div class="box-header">
      <form action="{{route('user.filter')}}" 
            method="post" 
            class="form form-inline">
        @csrf
        
        <input type="text" name="name" class="form-control" 
               placeholder="Digite o nome"
               style="margin-right: 5px;">

        <input type="text" 
               name="msisdn" class="form-control" 
               placeholder="Digite Telefone"
               id="msisdn"
               style="margin-right: 5px;">

        <button type="submit" class="btn btn-success">
        Pesquisar</button>
      </form>      
    </div> 
    <table class="table table-borderred table-hover table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Telefone</th>
          <th>Acess_Level</th>
          <th>Atualizado</th>
          <th>Grupo</th>
        </tr>  
      </thead>
      <tbody>
        @forelse($userList as $u)
         <tr>
          <td>{{$u->id}}</td>
          <td>{{$u->name}}</td>
          <td>{{$helper->formatPhone($u->msisdn)}}</td>
          <td>{{$u->access_level}}</td>
          <td>{{$helper->formatDate($u->updated_at)}}</td>
          <td>
            <a href="{{route('group.create', $u->id)}}" target="_blank">
              <i class="fa fa-users" aria-hidden="true">
              </i> 
            </a>  
          </td> 
          <td>
            <form action="{{route('user.edit', $u->id)}}">
              <button type="submit" 
                      class="btn btn-success btn-sm">
                <i class="fas fa-pen"></i> 
              </button>       
            </form>
          </td> 
          <td>
            <a  href="{{route('user.show', $u->id)}}" 
               class="btn btn-primary btn-sm">
              <i class="fas fa-search"></i> 
            </a>  
          </td>
          <td>
            <form method="post"  
                  action="{{route('user.destroy', $u->id)}}"
                  onsubmit="return confirm('Tem certeza que deseja remover o usuário {{ addslashes($u->name)}}?')">
                  @csrf
                  @method('DELETE')
                                               
                  <button type="submit" 
                          class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                  </button>                 
            </form>  
          </td>
         </tr>
         @empty
           <p>sem Registro</p>
         @endforelse
      </tbody>
    </table>              
  </div>  
@endsection