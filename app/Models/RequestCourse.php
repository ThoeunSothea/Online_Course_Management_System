<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCourse extends Model
{
    use HasFactory;

    protected $table = 'tbl_request_courses';
    protected $primaryKey = 'request_id';
    protected $fillable = ['prof_id', 'approval_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }

    public function approval()
    {
        return $this->belongsTo(Approval::class, 'approval_id', 'approval_id');
    }
}
