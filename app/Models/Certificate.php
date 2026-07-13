<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'child_id',
        'course_id',
        'issue_date',
        'certificate_code',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
