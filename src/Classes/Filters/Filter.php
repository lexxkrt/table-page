<?php
namespace Lexxkrt\TablePage\Classes\Filters;

use Illuminate\Support\Str;

class Filter
{
    public string $component = "";
    public string $filter = "";
    public string $label = "";

    public function __construct($filter, $label)
    {
        $this->filter = $filter;
        $this->label = $label;
    }

    public static function make($filter, $label = "")
    {
        empty($label) and $label = Str::title($filter);
        return new static($filter, $label);
    }
}
