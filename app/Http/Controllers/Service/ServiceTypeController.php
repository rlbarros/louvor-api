<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\CrudController;
use App\Models\Music\Style;
use App\Models\Service\ServiceType;
use Illuminate\Database\Eloquent\Model;

class ServiceTypeController extends CrudController
{

    function model(): Model
    {
        return new ServiceType();
    }

    function validations(): array
    {
        return [
            'name' => 'required',
            'music_count' => 'required'
        ];
    }

    function modelName(): string
    {
        return "tipo de culto";
    }
}
