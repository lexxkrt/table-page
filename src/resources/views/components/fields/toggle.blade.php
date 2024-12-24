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
    <label class="inline-flex cursor-pointer items-center">
        <input name="{{ $field->name }}" type="checkbox" class="peer sr-only" wire:model="{{ $field->key }}">
        <div
             class="dark:bg-gray-800 dark:border-gray-600 peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none rtl:peer-checked:after:-translate-x-full">
        </div>
        <span class="dark:text-gray-300 ms-3 text-sm font-medium text-gray-900">{{ __($field->label) }}</span>
    </label>
    @error($field->key)
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
