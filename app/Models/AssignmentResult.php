<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentResult extends Model
{
    use HasFactory;

    protected $table = 'tbl_assignment_results';
    protected $primaryKey = 'assignment_result_id';
    protected $fillable = ['prof_id', 'assign_submission_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }

    public function assignmentSubmission()
    {
        return $this->belongsTo(AssignmentSubmission::class, 'assign_submission_id', 'assign_submission_id');
    }
}
