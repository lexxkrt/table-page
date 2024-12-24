<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Lexxkrt\TablePage\Classes\Fields\Field;

class FieldInput extends Field
{
    public string $component = "table-page::fields.input";

    public string $type = "text";

    public string|null $placeholder = null;

    public function placeholder(string|null $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }
}
