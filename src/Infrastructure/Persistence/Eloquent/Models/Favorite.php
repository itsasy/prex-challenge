<?php

namespace Src\Infrastructure\Persistence\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'gif_id',
        'alias',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
