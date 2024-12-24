<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Illuminate\Support\Str;

abstract class Field
{
    public string $component = "";
    public string $name = "";
    public string $label = "";
    public string $key = "";
    public array|string|null $rules = "";
    public int|null $span = null;
    public mixed $default = null;

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
        $this->key = 'form_data.' . Str::snake($name);
    }

    public static function make($name, $label = '')
    {
        empty($label) and $label = Str::title(Str::replace('_', ' ', $name));
        return new static($name, $label);
    }

    public function rules(array|string|null $rules)
    {
        $this->rules = $rules;
        return $this;
    }

    public function span($span)
    {
        $this->span = $span;
        return $this;
    }

    public function default($default)
    {
        $this->default = $default;
        return $this;
    }
}
