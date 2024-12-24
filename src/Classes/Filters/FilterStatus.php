<?php
namespace Lexxkrt\TablePage\Classes\Filters;

use Closure;
use Lexxkrt\TablePage\Classes\Filters\FilterSelect;

class FilterStatus extends FilterSelect
{
    public string $component = "table-page::filters.select";
    public array|Closure|null $options = null;

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->options = function () {
            return [
                '1' => 'Active',
                '0' => 'Inactive',
            ];
        };
    }

    public function options(array|Closure|null $options)
    {
        $this->options = $options;
        return $this;
    }
}
