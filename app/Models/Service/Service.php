<?php

namespace App\Models\Service;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Ministry;
use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use TableTrait;

    protected $table = 'services';


    protected $fillable = [
        'day',
        'service_rype_id',
        'ministry_id',
    ];

    public $timestamps = false;

    public function ServiceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function Ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class, 'ministry_id');
    }
}
