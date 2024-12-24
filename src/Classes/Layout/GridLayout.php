<?php
namespace Lexxkrt\TablePage\Classes\Layout;

class GridLayout
{
    public string $component = "table-page::layouts.grid";
    public int $column = 2;
    public $fields = [];

    public function __construct($column)
    {
        $this->column = $column;
    }

    public static function make($column = 2)
    {
        return new static($column);
    }

    public function column($column = 2)
    {
        $this->column = $column;
        return $this;
    }

    public function fields($fields = [])
    {
        $this->fields = $fields;
        return $this;
    }
}
