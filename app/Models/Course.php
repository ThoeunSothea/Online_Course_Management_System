<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'tbl_courses';
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'cate_id', 'schedule_id', 'status_id', 'course_title', 'description', 'approve_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'cate_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Profile::class, 'tbl_instructor_courses', 'course_id', 'prof_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id', 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'course_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'course_id', 'course_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'course_id', 'course_id');
    }

    public function courseCarts()
    {
        return $this->hasMany(CourseCart::class, 'course_id', 'course_id');
    }

    public function courseCategories()
    {
        return $this->hasMany(CourseCategory::class, 'course_id', 'course_id');
    }

    public function courseSchedules()
    {
        return $this->hasMany(CourseSchedule::class, 'course_id', 'course_id');
    }
}
