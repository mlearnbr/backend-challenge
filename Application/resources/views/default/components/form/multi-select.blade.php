<div class="form-group{{ $errors->has($name)?' has-error' :'' }}">
    {{ Form::label("input-{$name}", $label ?? __("attributes.{$name}") ,
     ['class' => (isset($vertical) && $vertical?'':'col-md-3').' control-label'.(isset($required) && $required == false?'':' required') ]) }}
    <div class="{{ (isset($vertical) && $vertical?'':'col-md-6') }}">
        {{ Form::select(
            $name,
            $data,
            old($name) ?? '',
            array_merge(
                [
                    'class' => 'form-control select2 ' . ($class ?? ''),
                    'multiple'
                ],
                ($attributes ?? []),
                ($options ?? [])
            )
           )
        }}
        <span class="help-block">{{$errors->first($name)}}</span>
    </div>
</div>
