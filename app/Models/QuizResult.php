<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $table = 'tbl_quiz_results';
    protected $primaryKey = 'quiz_result_id';
    protected $fillable = ['prof_id', 'quiz_submission_id'];

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }

    public function quizSubmission()
    {
        return $this->belongsTo(QuizSubmission::class, 'quiz_submission_id', 'quiz_submission_id');
    }
}
