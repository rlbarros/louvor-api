<?php

namespace App\Models\Service;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;



class ServiceType extends Model
{
    use TableTrait;

    protected $table = 'service_types';


    protected $fillable = [
        'name',
        'music_count',
    ];

    public $timestamps = false;

    public function toStringClass()
    {
        $message = $this->name;
        return $message;
    }
}
