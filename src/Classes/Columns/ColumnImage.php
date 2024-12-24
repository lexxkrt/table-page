<?php
namespace Lexxkrt\TablePage\Classes\Columns;

use Closure;
use Lexxkrt\TablePage\Classes\Columns\Column;

class ColumnImage extends Column
{
    public string $component = "table-page::columns.image";
    public string|Closure|null $src = null;
    public string|Closure|null $preview = null;
    public string $size = 'size-10';

    public function src(string|Closure|null $src)
    {
        $this->src = $src;
        return $this;
    }

    public function preview(string|Closure|null $preview)
    {
        $this->preview = $preview;
        return $this;
    }

    public function size(string $size)
    {
        $this->size = $size;
        return $this;
    }

}
