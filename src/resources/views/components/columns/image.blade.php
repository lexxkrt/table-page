@props(['column', 'row'])
@php
    $src = value($column->src, $row) ?? asset('images/no_img.jpg');
    $preview = value($column->preview, $row);
@endphp

@if ($preview)
    <div {{ $attributes->class(['cursor-pointer flex items-center justify-center']) }}>
        <img @class([$column->size, 'object-contain']) src="{{ $src }}" alt=""
             x-on:click="$dispatch('preview',{image:'{{ $preview }}'})">
    </div>
@else
    <div {{ $attributes->class(['flex items-center justify-center']) }}>
        <img @class([$column->size, 'object-contain']) src="{{ $src }}" alt="">
    </div>
@endif

@once
    <div x-data="{ show: false }"
         x-show="show"
         x-trap.noscroll="show"
         class="z-40"
         x-on:keydown.escape.window="$dispatch('close')"
         x-on:close="show=false"
         x-on:preview.window="$refs.previewImage.src=$event.detail.image;show=true"
         x-cloak>
        <div class="fixed inset-0 z-40 bg-black/30 backdrop-blur" x-on:click="$dispatch('close')"></div>
        <div class="fixed inset-0 z-40 m-auto flex max-h-[800px] w-full max-w-[800px] items-center justify-center rounded-lg bg-white p-6 dark:bg-slate-800">
            <span class="absolute right-0 top-0 cursor-pointer rounded-full bg-gray-100 p-2 hover:bg-gray-200 dark:bg-slate-900/30 dark:hover:bg-slate-900" x-on:click="$dispatch('close')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
            <div class="block h-full max-h-[800px] overflow-hidden rounded-lg dark:bg-slate-800">
                <img class="h-full object-scale-down" x-ref="previewImage" src="" alt="">
            </div>
        </div>
    </div>
@endonce
