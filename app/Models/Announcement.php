<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'tbl_announcements';
    protected $primaryKey = 'announcement_id';
    protected $fillable = ['course_id', 'prof_id', 'message', 'sent_at'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }
}
