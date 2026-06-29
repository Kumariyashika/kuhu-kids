<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        'parent_id',
        'user_id',
        'name',
        'avatar_id',
        'streak',
        'xp',
        'stars',
        'coins',
        'level',
        'age',
        'last_active_at',
        'current_outfit'
    ];

    protected $casts = [
        'last_active_at' => 'datetime',
    ];

    public function parentProfile()
    {
        return $this->belongsTo(ParentProfile::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class, 'avatar_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'child_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'child_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'child_id');
    }

    public function screenTimes()
    {
        return $this->hasMany(ScreenTime::class, 'child_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'child_badge')->withPivot('unlocked_at');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'child_reward')->withPivot('is_active', 'unlocked_at');
    }
}
