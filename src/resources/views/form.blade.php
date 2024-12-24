<x-table-page::modal size="{{ $form_size }}">
    <x-slot:title>{{ $this->formTitle() }}</x-slot:title>
    <form wire:submit="store" class="space-y-3">
        @foreach ($this->fields() as $field)
            <x-dynamic-component :component="$field->component"
                                 :$field />
        @endforeach
        <div class="text-right">
            <x-table-page::button-primary type="submit">{{ __('Save') }}</x-table-page::button-primary>
            <x-table-page::button-secondary type="button" wire:click="$dispatch('form-close')">{{ __('Cancel') }}</x-table-page::button-secondary>
        </div>
    </form>
</x-table-page::modal>
