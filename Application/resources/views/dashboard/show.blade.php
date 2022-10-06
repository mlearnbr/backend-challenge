@extends('adminlte::page')

@section('title', __('models.users') . ' - ' . __('elements.show'))

@section('content_header')
    <h1>{{ __('models.users') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header with-border">
                <h3 class="card-title">{{ __('elements.show') }}</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>{{ __('attributes.id') }}</th>
                        <td><i>{{ $user->id }}</i></td>
                    </tr>
                    <tr>
                        <th>{{ __('attributes.name') }}</th>
                        <td><i>{{ $user->name }}</i></td>
                    </tr>
                    <tr>
                        <th>{{ __('attributes.msisdn') }}</th>
                        <td><i>{{ $user->msisdn }}</i></td>
                    </tr>
                    <tr>
                        <th>{{ __('attributes.access_level') }}</th>
                        <td><i>{{ $user->access_level }}</i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-block btn-info col-md-12"
                >
                    <i class="fa fa-list"></i> {{ __('buttons.back_to_list') }}
                </a>

                <a
                    href="{{ route('users.edit', compact('user')) }}"
                    class="btn btn-block btn-primary col-md-12"
                >
                    <i class="fa fa-edit"></i> {{__('buttons.edit')}}
                </a>

                <a
                    href="{{ route('users.destroy', compact('user')) }}"
                    class="btn btn-block btn-danger col-md-12"
                    method="DELETE"
                    message="{{__('flash.delete_question', ['entity' => __('models.user') . ' ' . $user->id])}}"
                >
                    <i class="fa fa-close"></i> {{__('buttons.delete')}}
                </a>
            </div>
        </div>
    </div>
</div>
@stop
