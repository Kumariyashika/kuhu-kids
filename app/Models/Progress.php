<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [
        'child_id',
        'course_id',
        'lesson_id',
        'quiz_id',
        'completed',
        'score',
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
