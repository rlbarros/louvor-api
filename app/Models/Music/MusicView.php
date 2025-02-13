<?php

namespace App\Models\Music;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MusicView extends Model
{
    use TableTrait;

    protected $table = 'vw_musics';


    protected $fillable = [
        'genre_id',
        'genre',
        'style_id',
        'style',
        'interpreter_id',
        'interpreter',
        'name',
    ];


    public $timestamps = false;
}
