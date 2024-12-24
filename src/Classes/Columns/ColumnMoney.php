<?php
namespace Lexxkrt\TablePage\Classes\Columns;

use Closure;
use Lexxkrt\TablePage\Classes\Columns\Column;

class ColumnMoney extends Column
{
    public string $component = "table-page::columns.money";
    public string $currency = "rub";
    public string $locale = "ru";

    public string|Closure|null $second = null;

    public function second(string|Closure|null $second)
    {
        $this->second = $second;
        return $this;
    }
}
