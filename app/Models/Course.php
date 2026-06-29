<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'category', 'icon', 'bg_color', 'is_active'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id')->orderBy('sorting_order');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'course_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'course_id');
    }
}
