<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['name', 'svg_markup'];

    public function children()
    {
        return $this->hasMany(Child::class, 'avatar_id');
    }
}
