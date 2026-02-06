{{-- select --}}
@php
	$current_value = old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '';
    $entity_model = $crud->getRelationModel($field['entity'],  - 1);
    $field['allows_null'] = $field['allows_null'] ?? $entity_model::isColumnNullable($field['name']);

    //if it's part of a relationship here we have the full related model, we want the key.
    if (is_object($current_value) && is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
        $current_value = $current_value->getKey();
    }

    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
@endphp

@include('crud::fields.inc.wrapper_start')

    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <span class="input-group-text">{!! $field['prefix'] !!}</span> @endif
        <select
            name="{{ $field['name'] }}"
            @include('crud::fields.inc.attributes', ['default_class' => 'form-control form-select'])
            >

            @if ($field['allows_null'])
                <option value="">-</option>
            @endif

            @if (count($options))
                @foreach ($options as $key => $value)
                    @if(is_object($value))
                        @if($current_value == $value->getKey())
                            <option value="{{ $value->getKey() }}" selected>{{ $value->{$field['attribute']} }}</option>
                        @else
                            <option value="{{ $value->getKey() }}">{{ $value->{$field['attribute']} }}</option>
                        @endif
                    @else
                        @if($current_value == $key)
                            <option value="{{ $key }}" selected>{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endif
                @endforeach
            @endif
        </select>
        @if(isset($field['suffix'])) <span class="input-group-text">{!! $field['suffix'] !!}</span> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

@include('crud::fields.inc.wrapper_end')
