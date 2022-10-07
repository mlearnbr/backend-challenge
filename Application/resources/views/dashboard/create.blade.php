@extends('adminlte::page')

@section('title', __('models.users') . ' - ' . __('elements.form_create'))

@section('content_header')
    <h1>{{ __('models.users') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div class="card-header with-border">
                <h3 class="card-title">{{ __('elements.form_create') }}</h3>
            </div>
            {!! Form::open(['url' => route('users.store'),
                               'method' => 'POST',
                                'class' => 'form-horizontal',
                                 'autocomplete' => 'off']) !!}
                @include('dashboard.partials._form')
                <div class="card-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> {{__('buttons.cancel')}}</a>
                    <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> {{__('buttons.create')}}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
