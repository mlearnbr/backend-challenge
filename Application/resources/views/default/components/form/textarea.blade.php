<div class="form-group{{ $errors->has($name)?' has-error' :'' }}">
    {{ Form::label("input-{$name}", $label ?? __("attributes.{$name}") , ['class' => 'col-md-3 control-label'.(isset($required) && $required == false?'':' required') ]) }}
    <div class="col-md-6">
        {{
            Form::textarea(
                $name,
                old($name)?old($name):($entity?$entity->$name:''),
                array_merge(
                    [
                        'class'=>'form-control ' . ($class ?? ''),
                        'placeholder'=> $placeholder ?? $label ?? __("attributes.{$name}"),
                        'id'=> "textarea-{$name}",
                         'rows' => $rows ?? "3"
                    ],
                    ($options ?? [])
                )
            )
        }}
        <span class="help-block">{{$errors->first($name)}}</span>
    </div>
</div>
