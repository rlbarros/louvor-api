<?php

namespace App\Models\Music;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Style extends Model
{
    use TableTrait;

    protected $table = 'styles';


    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
