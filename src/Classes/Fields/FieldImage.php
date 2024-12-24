<?php
namespace Lexxkrt\TablePage\Classes\Fields;

use Lexxkrt\TablePage\Classes\Fields\Field;

class FieldImage extends Field
{
    public string $component = "table-page::fields.image";

    public string $type = "file";

    public string|null $placeholder = null;
    public string|null $uploadDirectory = null;

    public function placeholder(string|null $placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function type(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function uploadDirectory(string $uploadDirectory)
    {
        $this->uploadDirectory = $uploadDirectory;
        return $this;
    }
}
