<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentProfile extends Model
{
    // Point to parents table explicitly to avoid naming conflict
    protected $table = 'parents';

    protected $fillable = ['user_id', 'phone', 'subscription_status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }
}
