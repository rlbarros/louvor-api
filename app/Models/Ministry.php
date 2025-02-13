<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Ministry extends Model
{
    use HasFactory, TableTrait;

    protected $table = 'ministries';


    protected $fillable = [
        'name',
        'state',
    ];

    public $timestamps = false;
}
