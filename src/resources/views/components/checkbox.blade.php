@props(['name' => '', 'label' => ''])
@php
    empty($name) and ($name = $attributes->get('wire:model', Str::random(8)));
    empty($label) and ($label = trans(Str::title($name)));
@endphp
<div class="mb-3 inline-flex w-full items-center">
    <input name="{{ $name }}" id="{{ $name }}"
           {{ $attributes->merge(['type' => 'checkbox'])->class(['w-auto mr-2 cursor-pointer', 'text-red-500' => $errors->has($name)]) }}>
    <label for="{{ $name }}" class="cursor-pointer select-none">{{ $label }}</label>
    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
