<?php
namespace Lexxkrt\TablePage\Classes\Actions;

use Illuminate\Support\Str;

abstract class Action
{
    public string $component = "";
    public string $action = "";
    public string $label = "";

    public function __construct($action, $label)
    {
        $this->action = $action;
        $this->label = $label;
    }

    public static function make($action, $label = '')
    {
        empty($label) and $label = Str::title($action);
        return new static($action, $label);
    }
}
