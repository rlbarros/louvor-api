<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\CrudController;
use App\Models\Service\ServiceMusic;
use Illuminate\Database\Eloquent\Model;

class ServiceMusicController extends CrudController
{

    function model(): Model
    {
        return new ServiceMusic();
    }

    function validations(): array
    {
        return [
            'service_id' => 'required',
            'music_id' => 'required'
        ];
    }

    function modelName(): string
    {
        return "música do culto";
    }
}
