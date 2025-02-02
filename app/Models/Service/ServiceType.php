<?php

namespace App\Models\Service;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;



class ServiceType extends Model
{
    use TableTrait;

    protected $table = 'services';


    protected $fillable = [
        'name',
        'number_count',
    ];

    public $timestamps = false;
}
