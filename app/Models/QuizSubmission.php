<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSubmission extends Model
{
    use HasFactory;

    protected $table = 'tbl_quiz_submissions';
    protected $primaryKey = 'quiz_submission_id';
    protected $fillable = ['quiz_id', 'prof_id', 'file_path', 'submitted_at', 'score', 'feedback'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'quiz_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'prof_id', 'prof_id');
    }

    public function result()
    {
        return $this->hasOne(QuizResult::class, 'quiz_submission_id', 'quiz_submission_id');
    }
}
