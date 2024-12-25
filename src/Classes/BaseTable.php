<?php
namespace Lexxkrt\TablePage\Classes;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Lexxkrt\TablePage\Classes\Layout\TabLayout;
use Lexxkrt\TablePage\Classes\Fields\FieldImage;
use Lexxkrt\TablePage\Classes\Layout\GridLayout;
use Lexxkrt\TablePage\Classes\Actions\ActionEdit;
use Lexxkrt\TablePage\Classes\Columns\ColumnText;
use Lexxkrt\TablePage\Classes\Actions\ActionDelete;

abstract class BaseTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected string $class;
    public ?Model $model = null;
    public $formShow = false;
    public $form_data = [];
    public string $form_size = "md"; // md,lg,xl,2xl,3xl,5xl

    public string $sortBy = "id";
    public string $sortDirection = "asc";

    public string $search = "";
    public array $filter = [];
    public array $uploads = [];

    abstract public function columns(): array;
    abstract public function fields(): array;

    public function title(): string
    {
        return Str::title(app($this->class)->getTable());
    }

    public function formTitle(): string
    {
        return $this->model?->exists ?
            __('Edit `:model`', ['model' => $this->model->name]) :
            __('Create new `:model`', ['model' => trans(Str::title(Str::singular(app($this->class)->getTable())))]);
    }

    public function query()
    {
        return app($this->class)->query();
    }
    public function with(): array
    {
        return [];
    }
    public function filters(): array
    {
        return [];
    }
    public function actions(): array
    {
        return [
            ActionEdit::make('edit'),
            ActionDelete::make('delete'),
        ];
    }

    #[Computed]
    public function data()
    {
        $query = $this->query();

        $query->when($this->searchables && $this->search, fn(Builder $q) => $q->whereAny($this->searchables, 'like', "%{$this->search}%"));

        foreach ($this->filter as $key => $value) {
            $query->when($value !== "", fn($q) => $q->where($key, $value));
        }
        return $query->with($this->with())
            ->when($this->sortBy, fn($q) => $q->orderBy($this->sortBy, $this->sortDirection))
            ->paginate();
    }

    #[Computed()]
    public function searchables()
    {
        $searchables = [];
        foreach ($this->columns() as $column) {
            if ($column instanceof ColumnText) {
                if ($column->searchable) {
                    $searchables[] = $column->field;
                }
            }
        }
        return $searchables;
    }

    public function sort($field)
    {
        if ($this->sortBy == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function toggle($id, $field)
    {
        $model = $this->query()->find($id);
        $model->update([$field => !$model->{$field}]);
    }

    public function updated($property, $value)
    {
        if (!Str::startsWith($property, 'form_data.')) {
            $this->resetPage();
        }
    }

    public function create()
    {
        $this->model = app($this->class);
        $this->form_data = [];
        $this->formShow = true;
    }

    public function edit($id)
    {
        $this->model = $this->query()->find($id);
        $this->form_data = $this->model->toArray();
        $this->form_data['image'] = null;
        $this->formShow = true;
    }

    private function getFields()
    {
        $fields = [];
        foreach ($this->fields() as $field) {
            if ($field instanceof TabLayout)
                $this->getFieldsFromTabLayout($fields, $field);
            else if ($field instanceof GridLayout)
                $this->getFieldsFromGridLayout($fields, $field);
            else
                $fields[$field->key] = $field;
        }
        return $fields;
    }

    private function getFieldsFromTabLayout(&$fields, $field)
    {
        foreach ($field->panes as $pane) {
            foreach ($pane->fields as $subField) {
                if ($subField instanceof TabLayout)
                    $this->getFieldsFromTabLayout($fields, $subField);
                else if ($subField instanceof GridLayout)
                    $this->getFieldsFromGridLayout($fields, $subField);
                else
                    $fields[$subField->key] = $subField;
            }
        }
    }

    private function getFieldsFromGridLayout(&$fields, $field)
    {
        foreach ($field->fields as $subField) {
            if ($subField instanceof TabLayout)
                $this->getFieldsFromGridLayout($fields, $subField);
            else if ($subField instanceof GridLayout)
                $this->getFieldsFromGridLayout($fields, $subField);
            else
                $fields[$subField->key] = $subField;
        }
    }

    public function store()
    {
        $fields = $this->getFields();
        $rules = Arr::mapWithKeys($fields, fn($field) => [$field->key => $field->rules]);
        $attributes = Arr::mapWithKeys($fields, fn($field) => [$field->key => $field->label]);
        $names = Arr::mapWithKeys(
            Arr::where($fields, fn($field) => !($field instanceof FieldImage)),
            fn($field) => [$field->key => $field->name]
        );
        $images = Arr::mapWithKeys(
            Arr::where($fields, fn($field) => $field instanceof FieldImage),
            fn($field) => [$field->key => $field->name]
        );

        $this->validate($rules, attributes: $attributes);

        $form_data = Arr::only($this->form_data, $names);
        $tables = app($this->class)->getTable();

        foreach ($images as $image) {
            if (array_key_exists($image, $this->uploads)) {
                $form_data[$image] = $this->uploads[$image]->store($tables, 'public');
            }
        }

        if ($this->model->exists) {
            $this->model->update($form_data);
        } else {
            $this->model->create($form_data);
        }

        $this->model = null;
        $this->form_data = [];
        $this->formShow = false;
    }
    public function delete($id)
    {
        $model = $this->query()->find($id);
        $model->delete();
    }

    #[On('form-close')]
    public function cancel()
    {
        $this->model = null;
        $this->form_data = [];
        $this->resetValidation();
        $this->formShow = false;
    }

    public function imageUrl($name)
    {
        if ($this->uploads) {
            return $this->uploads[$name]->temporaryUrl();
        } else {
            if ($this->model->image ?? false)
                return $this->model->image;
        }
        return asset('images/no_img.jpg');
    }

    public function render()
    {
        return view('table-page::table');
    }
}
