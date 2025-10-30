<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $table = 'tbl_assignment_submissions';
    protected $primaryKey = 'assign_submission_id';
    protected $fillable = ['assignment_id', 'prof_id', 'file_path', 'submitted_at', 'score', 'feedback'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id', 'assignment_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }

    public function result()
    {
        return $this->hasOne(AssignmentResult::class, 'assign_submission_id', 'assign_submission_id');
    }
}
