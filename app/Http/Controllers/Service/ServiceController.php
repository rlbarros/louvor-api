<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\CrudController;
use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceController extends CrudController
{

    function model(): Model
    {
        return new Service();
    }

    function validations(): array
    {
        return [
            'day' => 'required',
            'service_type_id' => 'required'
        ];
    }

    function modelName(): string
    {
        return "culto";
    }
}
