<?php

namespace App\Models\Service;

use App\Models\Music\Music;
use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceMusic extends Model
{
    use TableTrait;

    protected $table = 'service_musics';


    protected $fillable = [
        'service_id',
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

    public function toStringClass()
    {
        $music = Music::find($this->music_id);
        $service = Music::find($this->service_id);

        $message = $music->name . ' do culto do dia ' . $service->day;
        return $message;
    }
}
