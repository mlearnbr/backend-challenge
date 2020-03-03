@extends('layout.app')
@section('content')

<div class="container h-100" style="margin-top: 1%;">    

    <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">MSISDN</th>
            <th scope="col">Acces Level</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($user as $user)
            <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->msisdn}}</td>
            <td>{{$user->access_level}}</td>
            <td> 
                <a class="btn btn-primary btn-sm" href="{{route('upgrade.user', $user->id)}}"><i class="fas fa-angle-up"></i> Upgrade</a>
                <a class="btn btn-danger btn-sm" href="{{route('downgrade.user', $user->id)}}"><i class="fas fa-angle-down"></i> Downgrade</a>
            </td>
          </tr>
        @endforeach
          
        </tbody>
      </table>

</div>


@endsection
