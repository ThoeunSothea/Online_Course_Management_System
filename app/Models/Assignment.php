<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'tbl_assignments';
    protected $primaryKey = 'assignment_id';
    protected $fillable = ['course_id', 'type_id', 'title', 'due_date', 'max_score'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function typeWork()
    {
        return $this->belongsTo(TypeWork::class, 'type_id', 'type_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id', 'assignment_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Profile::class, 'tbl_instructor_assignments', 'assignment_id', 'prof_id');
    }
}
