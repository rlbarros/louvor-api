<?php 

namespace App\Traits;

trait ToStringNameTrait
{
    
    private static function toString($id, $name) {
        return $id . ' - ' . $name;
    }

    public function toStringClass() {
        return static::toString($this->id, $this->name);
    }
}