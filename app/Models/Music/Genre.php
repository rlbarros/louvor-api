<?php

namespace App\Models\Music;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Genre extends Model
{
    use TableTrait;

    protected $table = 'genres';


    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function toStringClass()
    {
        $message = $this->name;
        return $message;
    }
}
