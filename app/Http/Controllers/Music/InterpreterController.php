<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\CrudController;
use App\Models\Music\Interpreter;
use Illuminate\Database\Eloquent\Model;

class InterpreterController extends CrudController
{

    function model(): Model
    {
        return new Interpreter();
    }

    function validations(): array
    {
        return [
            'name' => 'required'
        ];
    }

    function modelName(): string
    {
        return "intérprete";
    }
}
