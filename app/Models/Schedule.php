<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'tbl_schedules';
    protected $primaryKey = 'schedule_id';
    protected $fillable = ['schedule_time'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'schedule_id', 'schedule_id');
    }

    public function courseSchedules()
    {
        return $this->hasMany(CourseSchedule::class, 'schedule_id', 'schedule_id');
    }
}
