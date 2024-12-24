@props(['field'])
<div x-data="{ tab: '{{ $field->panes[0]->name }}' }" x-init="$watch('show', value => { tab = value ? '{{ $field->panes[0]->name }}' : '' })">
    {{-- header --}}
    <div>
        @foreach ($field->panes as $pane)
            <a :key="{{ $pane->name }}"
               class = "dark:bg-slate-800 dark:border-slate-900 dark:text-gray-300 dark:hover:bg-slate-800/50 translate-y-[1px] cursor-pointer select-none rounded-t border border-slate-400 bg-slate-200 px-3 py-2 font-bold text-gray-700 hover:bg-slate-200/50 hover:no-underline"
               :class="{ '!border-b-transparent dark:!bg-slate-700 !bg-slate-300': tab == '{{ $pane->name }}' }"
               x-on:click="tab='{{ $pane->name }}'">{{ __($pane->label) }}</a>
        @endforeach
    </div>
    {{-- pane --}}
    <div class="dark:border-slate-900 border border-slate-400 p-4">
        @foreach ($field->panes as $pane)
            <div x-cloak x-show="tab=='{{ $pane->name }}'" class="">
                @foreach ($pane->fields as $elem)
                    <x-dynamic-component :component="$elem->component"
                                         :field="$elem" />
                @endforeach
            </div>
        @endforeach
    </div>
</div>
