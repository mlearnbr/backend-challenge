@extends('adminlte::page')

@section('title', __('models.users') . ' - ' . __('elements.list'))

@section('content_header')
    <h1>{{ __('models.users') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="card card-default">
            <div class="card-header with-border">
                <h3 class="card-title">{{ __('elements.list') }}</h3>
                <a href="{{ route('users.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> {{__('buttons.new')}}</a>
            </div>
            <div class="card-body">
                @datatable([
                    'url' => route('users.datatable'),
                    'resource_table' => 'users',
                    'columns' => [
                        ['name'=>'id'],
                        ['name'=>'name'],
                        ['name'=>'msisdn'],
                        ['name'=>'access_level'],
                    ],
                    'actions' => [
                        'label' => __('elements.options'),
                        'links' => [
                            [
                                'title' => __('buttons.show'),
                                'url' => route('users.show', '(id)'),
                                'icon' => 'fa-search'
                            ],
                            [
                                'title' => __('buttons.upgrade'),
                                'url' => route('users.upgrade', '(id)'),
                                'method' => 'put',
                                'icon' => 'fa-arrow-up',
                                'class' => 'text-success'
                            ],
                            [
                                'title' => __('buttons.downgrade'),
                                'url' => route('users.downgrade', '(id)'),
                                'method' => 'put',
                                'icon' => 'fa-arrow-down',
                                'class' => 'text-danger'
                            ],
                            [
                                'title' => __('buttons.edit'),
                                'url' => route('users.edit', '(id)'),
                                'icon' => 'fa-edit'
                            ],
                            [
                                'title' => __('buttons.delete'),
                                'url' => route('users.destroy', '(id)'),
                                'method' => 'delete',
                                'message' => __('flash.delete_question', ['entity' => __('models.admin') . " (name)"]),
                                'icon' => 'fa-times',
                                'class' => 'text-danger'
                            ],
                        ],
                        'width' => '130px',
                        'class' => 'text-center'
                    ]
                ])@enddatatable
            </div>
            <div class="card-footer">
                <a href="{{ route('users.create') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> {{__('buttons.new')}}</a>
            </div>
        </div>
    </div>
</div>
@stop
