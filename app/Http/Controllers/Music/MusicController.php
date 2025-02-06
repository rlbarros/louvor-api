<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\CrudController;
use App\Models\Music\Style;
use Illuminate\Database\Eloquent\Model;

class MusicController extends CrudController
{

    function model(): Model
    {
        return new Style();
    }

    function validations(): array
    {
        return [
            'name' => 'required',
            'style_id' => 'required',
            'genre_id' => 'required',
            'interpreter_id' => 'required',
        ];
    }

    function modelName(): string
    {
        return "estilo";
    }
}
