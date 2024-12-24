<div class="space-y-3">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">{{ __($this->title()) }}</h1>
        <div class="">
            <x-table-page::button-primary wire:click="create">{{ __('Create') }}</x-table-page::button-primary>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="">
            <div class="inline-flex items-center gap-3">
                {{-- <x-select class="w-20" wire:model.live="perPage" inline :options="$this->perPageOptions()" label="{{ __('Per page') }}" /> --}}
                @foreach ($this->filters() as $key => $filter)
                    <x-dynamic-component :component="$filter->component"
                                         :filter="$filter"
                                         :key="$key" />
                @endforeach
            </div>
        </div>
        <div class="">
            @if ($this->searchables())
                <div class="inline-flex items-center gap-2">
                    <label for="search">{{ __('Search') }}</label>
                    <input type="text" name="search" id="search" wire:model.live.debounce.500ms="search">
                </div>
            @endif
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    @foreach ($this->columns() as $column)
                        <x-table-page::th :$column />
                    @endforeach
                    @if ($this->actions())
                        <th class="w-20">
                            {{ __('Actions') }}
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($this->data as $row)
                    <tr>
                        @foreach ($this->columns() as $column)
                            <td @class(['hidden' => $column->hidden])><x-dynamic-component :component="$column->component"
                                                     :$column
                                                     :$row />
                            </td>
                        @endforeach
                        @if ($this->actions())
                            <td class="text-center">
                                <div class="inline-flex items-center gap-2 px-4">
                                    @foreach ($this->actions() as $action)
                                        <x-dynamic-component :component="$action->component"
                                                             :$action
                                                             :$row />
                                    @endforeach
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($this->columns()) }}">{{ __('No record found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>
        {{ $this->data->links() }}
    </div>
    @include('table-page::form')
</div>
