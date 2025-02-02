<?php

namespace App\Traits;

use App\Enums\Api\SourceEnum;
use App\Models\App\AppField;

trait ViewFillableTrait
{ 

    public function getFields() {
        $parentClass = get_parent_class($this);
        $parentObject = new $parentClass();
        $parentFields = $parentObject->getFields();
        $viewFields =  FillableTrait::fillLabelAndSource($this->fields, SourceEnum::VIEW);
        $viewAppFields = array();
        foreach($viewFields as $field) {
            $viewAppField = new AppField($field);
            array_push($viewAppFields, $viewAppField);
        }
        $allFields = array_merge($parentFields, $viewAppFields);
        $allFields = FillableTrait::sort($allFields);
        return $allFields;
    }    

    public function getFillable()
    {
        $fillable = array_map(function ($item) {
            return $item->name;
        }, $this->getFields());
        return $fillable;
    }

    
}