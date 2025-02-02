<?php 

namespace App\Traits;

trait TableTrait
{
    public static function tableName()
    {
        return (new static)->getTable();
    }
}