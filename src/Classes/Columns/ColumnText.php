<?php
namespace Lexxkrt\TablePage\Classes\Columns;

use Closure;
use Lexxkrt\TablePage\Classes\Columns\Column;

class ColumnText extends Column
{
    public string $component = "table-page::columns.text";

    public string|Closure|null $description = null;
    public int|bool $limit = false;

    public bool $searchable = false;

    public function description(string|Closure|null $description)
    {
        $this->description = $description;
        return $this;
    }

    public function limit(int|bool $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function searchable()
    {
        $this->searchable = true;
        return $this;
    }

}
