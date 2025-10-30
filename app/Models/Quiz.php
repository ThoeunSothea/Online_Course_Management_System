<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'tbl_quizzes';
    protected $primaryKey = 'quiz_id';
    protected $fillable = ['course_id', 'title', 'question'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function submissions()
    {
        return $this->hasMany(QuizSubmission::class, 'quiz_id', 'quiz_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Profile::class, 'tbl_instructor_quizzes', 'quiz_id', 'prof_id');
    }
}
