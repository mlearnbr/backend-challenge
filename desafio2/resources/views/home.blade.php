@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista dos usuários </div>

                <div class="card-body table-striped">
                    <a class='btn btn-info' href="{{ url('/register') }}">
                        <i class="fa fa-add" aria-hidden="true"></i> Add new user
                    </a>
                    <p>
                    <div class="table-responsive">
                        <table class="table">
                          <thead class="">
                              <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Phone (msisdn)</th>
                            <th class="text-center">Access Level</th>
                            <th class="text-right">Actions</th>
                          </thead>
                          <tbody>
                              @foreach($users as $user)
                                  <tr>
                                      <td class="text-center">{{ $user->id }}</td>
                                      <td class="text-center">{{ $user->name }}</td>
                                      <td class="text-center">{{ $user->msisdn }}</td>
                                      <td class="text-center">{{ $user->access_level }}</td>
                                        <td class="td-actions text-right">
                                            <a title="Upgrade" href="{{ url("users/{$user->id}/edit") }}" class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit" aria-hidden="true"></i></a>                                          
                                            <a title="Downgrade " href="{{ url("users/{$user->id}/delete") }}" class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-trash" aria-hidden="true"></i></a>                                          
                                        </td>
                                  </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>                                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
