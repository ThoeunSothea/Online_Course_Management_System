<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'tbl_profiles';
    protected $primaryKey = 'prof_id';
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'headline', 'biography',
        'profile_photo', 'website', 'telegram', 'youtube', 'linkedin', 'tiktok'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tbl_instructor_courses', 'prof_id', 'course_id');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'tbl_instructor_assignments', 'prof_id', 'assignment_id');
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'tbl_instructor_quizzes', 'prof_id', 'quiz_id');
    }
}
