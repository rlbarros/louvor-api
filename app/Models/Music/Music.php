<?php

namespace App\Models\Music;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Music extends Model
{
    use TableTrait;

    protected $table = 'musics';


    protected $fillable = [
        'genre_id',
        'style_id',
        'interpreter_id',
        'name',
    ];

    public function Genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function Style(): BelongsTo
    {
        return $this->belongsTo(Style::class, 'style_id');
    }

    public function Interpreter(): BelongsTo
    {
        return $this->belongsTo(Interpreter::class, 'style_id');
    }

    public $timestamps = false;
}
