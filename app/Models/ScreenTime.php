<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScreenTime extends Model
{
    protected $table = 'screen_times';

    protected $fillable = [
        'child_id',
        'date',
        'duration_seconds',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}
