@props(['column', 'row'])
@php
    $value = value($column->value, $row) ?? $row->{$column->field};
    $description = value($column->description, $row);
    $column->limit and ($value = Str::limit($value, $column->limit));
@endphp

<div @class([$column->align])>{{ $value }}</div>
@if ($description)
    <div class="text-xs opacity-70">{{ $description }}</div>
@endif
