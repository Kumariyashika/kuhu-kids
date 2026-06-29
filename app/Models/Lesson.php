<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'content_type',
        'body_content',
        'image_url',
        'audio_url',
        'sorting_order'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'lesson_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'lesson_id');
    }
}
