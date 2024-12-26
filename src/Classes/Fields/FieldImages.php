<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Closure;
use Lexxkrt\TablePage\Classes\Fields\Field;

class FieldImages extends Field
{
    public string $component = "table-page::fields.images";

    public array|Closure|null $images = [];
    public string|null $uploadDirectory = null;

    public function uploadDirectory(string $uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
        return $this;
    }

    public function images(array|Closure|null $images){
        $this->images = $images;
        return $this;
    }
}
