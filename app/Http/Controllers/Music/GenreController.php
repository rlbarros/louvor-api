<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\CrudController;
use App\Models\Music\Genre;
use Illuminate\Database\Eloquent\Model;

class GenreController extends CrudController
{

    function model(): Model
    {
        return new Genre();
    }

    function validations(): array
    {
        return [
            'name' => 'required'
        ];
    }

    function modelName(): string
    {
        return "gênero";
    }
}
