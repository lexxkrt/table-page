@props(['name', 'label'])
<div class="flex flex-col space-y-1">
    <label for="{{ $name }}" @class(["after:content-['*'] after:ml-1 after:text-red-500" => $attributes->has('required'),])>{{ $label }}</label>
    <input {{ $attributes->merge(['type' => 'text'])->class(['border-red-500' => $errors->has($name)]) }} name="{{ $name }}" id="{{ $name }}">
    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
