@props(['name' => '', 'label' => '', 'options' => []])
@php
    empty($name) and ($name = $attributes->get('wire:model', Str::random(8)));
    empty($label) and ($label = Str::title($name));
@endphp
<div class="flex flex-col gap-1">
    <label for="{{ $name }}" @class([
        "after:content-['*'] after:ml-1 after:text-red-500" => $attributes->has(
            'required'),
    ])>{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->class(['border-red-500' => $errors->has($name)]) }}>
        @foreach ($options as $value => $option)
            <option value="{{ $value }}">{{ $option }}</option>
        @endforeach
    </select>
    @error($name)
        <span class="mb-3 text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
