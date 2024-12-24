@props(['column', 'row'])
@php
    $value = value($column->value, $row) ?? $row->{$column->field};
@endphp

<div wire:click="toggle({{ $row->id }},'{{ $column->field }}')"
     @class([
         'border rounded-lg cursor-pointer select-none',
         'border-green-700 text-green-700 bg-green-700/20 dark:border-green-500 dark:text-green-500 hover:bg-green-700/30' => $value,
         'border-gray-500 text-gray-500 bg-gray-700/10 hover:bg-gray-700/30' => !$value,
         'hidden' => $column->hidden,
         $column->align,
     ])>{{ $value ? __('Active') : __('Inactive') }}</div>
