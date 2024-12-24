@props(['name', 'label', 'image' => false])
@php
    empty($name) and ($name = $attributes->get('wire:model', Str::random(8)));
    empty($label) and ($label = trans(Str::title(array_pop(explode('.', $name)))));
@endphp
<div class="dark:bg-slate-700 dark:border-slate-500 flex flex-col border border-slate-400 bg-slate-100">
    <div class="relative flex max-h-48 w-full rounded p-2">
        <div class="flex w-full justify-center">
            <img src="{{ $image ?? asset('images/no_img.jpg') }}" alt="">
        </div>
        <span
              x-on:click="$wire.set('form.image','');$wire.set('form.upload',null);document.getElementsByName('{{ $name }}')[0].value = ''"
              class="absolute -right-2 -top-2 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-500 bg-white text-red-400 hover:text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
        </span>
    </div>
    <div class="mb-3 px-3 py-2 text-center">
        <label class="mr-0 inline-flex cursor-pointer rounded-md bg-blue-500 px-3 py-2 text-white hover:bg-blue-600" for="{{ $name }}">{{ $label }}</label>
        <input {{ $attributes }} class="hidden cursor-pointer border-none" type="file" name="{{ $name }}" id="{{ $name }}">
        @error($name)
            <span>{{ $message }}</span>
        @enderror
    </div>
</div>
