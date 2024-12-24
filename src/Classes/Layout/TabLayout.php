<?php
namespace Lexxkrt\TablePage\Classes\Layout;

use Illuminate\Support\Str;

class TabLayout
{
    public string $component = "table-page::layouts.tab";
    public string $name = "";
    public string $label = "";
    public $panes = [];

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

    public function panes($panes = [])
    {
        $this->panes = $panes;
        return $this;
    }
}
