@props(['field'])
@php
    $span = match ($field->span) {
        1 => 'col-span-1',
        2 => 'col-span-2',
        3 => 'col-span-3',
        4 => 'col-span-4',
        5 => 'col-span-5',
        6 => 'col-span-6',
        default => '',
    };
@endphp
<div class="{{ $span }} flex flex-col gap-1">
    <label for="{{ $field->name }}">{{ __($field->label) }}</label>
    <input name="{{ $field->name }}"
           id="{{ $field->name }}"
           placeholder="{{ __($field->placeholder ?? $field->label) }}"
           type="{{ $field->type }}"
           wire:model="{{ $field->key }}"
           @class(['border-red-500' => $errors->has($field->key)])>
    @error($field->key)
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
