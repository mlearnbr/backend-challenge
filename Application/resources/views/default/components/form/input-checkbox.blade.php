<div class="form-group">
    <div class="col-md-offset-3 checkbox">
        <label>
            @if (isset($off))
                {{ Form::hidden($name, $off) }}
            @endif
            {{ Form::checkbox(
                $name,
                $on ?? 'on',
                old($name)?old($name):($entity?$entity->$name:''),
                array_merge([
                    'class' => ($class ?? ''),
                    'i-check' => '',
                ], ($options ?? []))
            )
            }}
            {{$label ?? __("attributes.{$name}")}}
        </label>
    </div>
</div>
