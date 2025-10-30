<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'tbl_approvals';
    protected $primaryKey = 'approval_id';
    protected $fillable = ['status'];

    public function requestCourses()
    {
        return $this->hasMany(RequestCourse::class, 'approval_id', 'approval_id');
    }
}
