@props(['size' => 'md', 'title' => ''])
@php
    $size = match ($size) {
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '5xl' => 'max-w-5xl',
        default => 'max-w-md',
    };
@endphp
<div x-cloak x-show="show" x-data="{ show: @entangle('formShow') }"
     x-trap.noscroll="show"
     class="fixed inset-0 z-40" x-on:keydown.escape.window="$dispatch('form-close')">
    <div class="fixed inset-0 z-40 h-screen w-full bg-black/30 backdrop-blur"></div>
    <div class="{{ $size }} fixed inset-0 z-40 mx-auto mt-12 h-screen w-full">
        <span class="absolute right-1 top-1 cursor-pointer rounded-full p-2 hover:bg-gray-100 dark:hover:bg-slate-900/50" x-on:click="$dispatch('form-close')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </span>
        <div class="rounded-lg bg-slate-300 p-10 shadow-lg dark:bg-slate-700">
            @if ($title)
                <h3 class="mb-3 text-2xl font-bold">{{ $title }}</h3>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
