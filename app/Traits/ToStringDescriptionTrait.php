<?php 

namespace App\Traits;

trait ToStringDescriptionTrait
{
    
    private static function toString($id, $descricao) {
        return $id . ' - ' . $descricao;
    }

    public function toStringClass() {
        return static::toString($this->id, $this->descricao);
    }
}