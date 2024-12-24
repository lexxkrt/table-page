<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Lexxkrt\TablePage\Classes\Fields\Field;

class FieldSelect extends Field
{
    public string $component = "table-page::fields.select";

    public array $options = [];
    public string|null $placeholder = null;

    public function placeholder(string|null $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }
}
