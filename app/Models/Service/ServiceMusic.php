<?php

namespace App\Models\Service;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Ministry;
use App\Models\Music\Music;
use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use TableTrait;

    protected $table = 'services';


    protected $fillable = [
        'sarvice_id',
        'music_id',
    ];

    public $timestamps = false;

    public function Service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function Music(): BelongsTo
    {
        return $this->belongsTo(Music::class, 'music_id');
    }
}
