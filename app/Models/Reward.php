<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'identifier',
        'coins_cost',
        'image_path',
    ];

    public function children()
    {
        return $this->belongsToMany(Child::class, 'child_reward')->withPivot('is_active', 'unlocked_at');
    }
}
