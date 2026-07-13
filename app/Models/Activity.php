<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'child_id',
        'activity_type',
        'activity_name',
        'details',
        'xp_earned',
        'stars_earned',
        'coins_earned',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
}
