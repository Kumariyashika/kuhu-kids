<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon_path',
        'requirement_type',
        'requirement_value',
    ];

    public function children()
    {
        return $this->belongsToMany(Child::class, 'child_badge')->withPivot('unlocked_at');
    }
}
