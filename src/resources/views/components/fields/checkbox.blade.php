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
    <label class="inline-flex items-center gap-2" for="{{ $field->name }}">
        {{-- @dump($this->form_data) --}}
        {{-- @dump($field) --}}
        {{-- @dump($this->form_data[$field->name] ?? 0) --}}
        <input
               name="{{ $field->name }}"
               id="{{ $field->name }}"
               type="checkbox"
               {{-- @checked($this->form_data[$field->name]??0?true:false) --}}
               wire:model="{{ $field->key }}">
        {{ __($field->label) }}
    </label>
    @error($field->key)
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
