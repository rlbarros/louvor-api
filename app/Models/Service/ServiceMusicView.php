<?php

namespace App\Models\Service;

use App\Models\Music\Music;
use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceMusicView extends Model
{
    use TableTrait;

    protected $table = 'vw_service_musics';


    protected $fillable = [
        'sarvice_id',
        'music_id',
        'music',
        'genre_id',
        'genre',
        'style_id',
        'style',
        'interpreter_id',
        'interpreter',
    ];

    public $timestamps = false;
}
