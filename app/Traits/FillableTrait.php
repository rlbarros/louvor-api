<?php

namespace App\Traits;

use App\Enums\Api\SourceEnum;
use App\Models\App\AppField;
use App\Utils\FieldUtil;

trait FillableTrait
{


    public static function fillLabelAndSource($fields, $source)  {
        $newFields = [];
        foreach($fields as $field) {
            $field['label'] = $field['name'];
            $field['source'] = $source;
            array_push($newFields, $field);
        }
        return $newFields;
    }


    public static function sort($fields) {
        if(!empty($fields)) {
            usort($fields, function ($a, $b): int {
                return FillableTrait::compare($a, $b);
            });
        }
        return $fields;
    }

    public static function compare($a, $b) {
        $orderA = $a->order;
        $orderB = $b->order;
        return $orderA > $orderB ? 1 : -1;
    }

    public function getFillable()
    {
        $fillable = array_map(function ($item) {
            return $item->name;
        }, $this->getFields());
        return $fillable;
    }

    public function getFields() {
        $fields = $this->fields;
        if(!is_array($this->primaryKey)) {
            array_push($fields, FieldUtil::id());
        }
        $fields = FillableTrait::fillLabelAndSource($fields, SourceEnum::TABLE);
        $appFields = array();
        foreach($fields as $field) {
            $appField = new AppField($field);
            array_push($appFields, $appField);
        }
        $appFields = FillableTrait::sort($appFields);
        return $appFields;
    }
}