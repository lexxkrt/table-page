<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Lexxkrt\TablePage\Classes\Fields\Field;

class FieldTextarea extends Field
{
    public string $component = "table-page::fields.textarea";
    public string|null $placeholder = null;
    public int $rows = 3;

    public function rows(int $row)
    {
        $this->rows = $row;
        return $this;
    }

    public function placeholder(string|null $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

}
