<?php
namespace Lexxkrt\TablePage\Classes\Columns;

use Closure;
use Illuminate\Support\Str;

abstract class Column
{
    public string $component = "table-page::column";
    public string $field = "";
    public string $label = "";

    public bool $sortable = false;
    public bool $hidden = false;


    public string $width = "";
    public string $align = "left text-left justify-start";

    public string|Closure|null $value = null;

    public function __construct($field, $label)
    {
        $this->field = $field;
        $this->label = $label;
    }

    public static function make($field, $label = '')
    {
        empty($label) and $label = Str::title($field);
        return new static($field, $label);
    }

    public function sortable()
    {
        $this->sortable = true;
        return $this;
    }

    public function hidden()
    {
        $this->hidden = true;
        return $this;
    }

    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    public function align($align)
    {
        $this->align = $align;
        return $this;
    }
    public function left()
    {
        return $this->align("left text-left justify-start");
    }
    public function center()
    {
        return $this->align("center text-center justify-center");
    }
    public function right()
    {
        return $this->align("right text-right justify-end");
    }

    public function value(string|Closure|null $value)
    {
        $this->value = $value;
        return $this;
    }
}
