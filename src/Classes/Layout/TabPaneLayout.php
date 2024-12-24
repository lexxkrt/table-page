<?php
namespace Lexxkrt\TablePage\Classes\Layout;

use Illuminate\Support\Str;

class TabPaneLayout
{
    public string $name = "";
    public string $label = "";
    public $fields = [];

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public static function make($name, $label = "")
    {
        empty($label) and $label = Str::title($name);
        return new static($name, $label);
    }

    public function fields($fields = [])
    {
        $this->fields = $fields;
        return $this;
    }
}
