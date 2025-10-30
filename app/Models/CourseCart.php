<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCart extends Model
{
    use HasFactory;

    protected $table = 'tbl_course_carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}
