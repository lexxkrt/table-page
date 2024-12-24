<?php
namespace Lexxkrt\TablePage\Classes\Filters;

use Closure;
use Lexxkrt\TablePage\Classes\Filters\Filter;

class FilterSelect extends Filter
{
    public string $component = "table-page::filters.select";
    public array|Closure|null $options = null;

    public function options(array|Closure|null $options)
    {
        $this->options = $options;
        return $this;
    }
}
