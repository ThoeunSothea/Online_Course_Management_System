<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'tbl_enrollments';
    protected $primaryKey = 'enrollment_id';
    protected $fillable = ['course_id', 'prof_id', 'enrollment_date'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }
}
