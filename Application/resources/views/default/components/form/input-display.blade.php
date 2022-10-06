<div class="form-group">
    {{ Form::label("input-{$name}", $label ?? __("attributes.{$name}") , ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-6">
        <div class="form-control" readonly>
            {{ $value ?? ($entity?$entity->$name:'') }}
        </div>
    </div>
</div>
