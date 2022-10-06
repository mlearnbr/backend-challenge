<div class="datatable table-responsive" config="{{ json_encode($config??[]) }}">
    <table class="dt-table table table-bordered table-hover table-striped" url="{{ $url }}">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th column-data="{{$column['as'] ?? (isset($column['relation']) ? "{$column['relation']}.{$column['name']}" : $column['name'])}}"
                    @if(isset($column['relation']) || isset($resource_table))
                        column-name="{{$column['relation'] ?? $resource_table}}.{{$column['name']}}"
                    @else
                        column-name="{{$column['name']}}"
                    @endif
                    column-class="{{ $column['class'] ?? '' }}"
                    @if(isset($column['width']))
                        column-width="{{$column['width']}}"
                    @endif
                @if(isset($column['options']))
                    @foreach($column['options'] as $option)
                        {{$option}}
                        @endforeach
                    @endif
                >
                    {{ $column['label'] ?? __("attributes.{$column['name']}") }}
                </th>
            @endforeach
            @isset($actions)
                <th actions column-class="{{ $actions['class'] ?? '' }}"
                    @isset($actions['width'])
                        column-width="{{$actions['width']}}"
                    @endisset
                    @foreach($actions['options'] ?? [] as $option)
                        {{$option}}
                    @endforeach
                    @isset($actions['links'])
                        data-links="{{ json_encode($actions['links']) }}"
                    @endisset
                >
                    {{ $actions['label'] }}
                </th>
            @endisset
        </tr>
        </thead>
    </table>
</div>
