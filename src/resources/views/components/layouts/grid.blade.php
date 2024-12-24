@props(['field'])
@php
    $cols = match ($field->column) {
        1 => 'grid-cols-1',
        2 => 'grid-cols-2',
        3 => 'grid-cols-3',
        4 => 'grid-cols-4',
        5 => 'grid-cols-5',
        6 => 'grid-cols-6',
    };
@endphp
<div class="{{ $cols }} grid gap-3">
    @foreach ($field->fields as $elem)
        @php
            $span = $elem->span;
        @endphp
        <x-dynamic-component class="{{ $span }}" :component="$elem->component"
                             :field="$elem" />
    @endforeach
</div>
