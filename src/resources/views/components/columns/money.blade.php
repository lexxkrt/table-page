@props(['column', 'row'])
@php
    $value = value($column->value, $row) ?? $row->{$column->field};
    $value = Number::currency($value, $column->currency, $column->locale);
    $second = value($column->second, $row);
    $second and ($second = Number::currency($second, $column->currency, $column->locale));
@endphp

@if ($second)
    <div @class(['text-xs line-through', $column->align])>{{ $value }}</div>
    <div @class(['dark:text-red-400 text-red-600', $column->align])>{{ $second }}</div>
@else
    <div @class([$column->align])>{{ $value }}</div>
@endif
