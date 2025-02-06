<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\CrudController;
use App\Models\Music\Style;
use Illuminate\Database\Eloquent\Model;

class StyleController extends CrudController
{

    function model(): Model
    {
        return new Style();
    }

    function validations(): array
    {
        return [
            'name' => 'required'
        ];
    }

    function modelName(): string
    {
        return "estilo";
    }
}
