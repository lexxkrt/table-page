@props(['filter', 'key'])
@php
    $options = value($filter->options);
@endphp
<div class="inline-flex items-center gap-2 transition-colors duration-500">
    <label for="{{ $key }}">{{ __($filter->label) }}</label>
    <select class="max-w-52" wire:model.live="filter.{{ $key }}" name="{{ $key }}" id="{{ $key }}">
        <option value="">{{ __('All') }}</option>
        @foreach ($options as $value => $title)
            <option value="{{ $value }}">{!! __($title) !!}</option>
        @endforeach
    </select>
</div>
