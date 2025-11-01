<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('course')->get();
        return response()->json($quizzes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'title'=>'required|string|max:255',
            'question'=>'required|string',
        ]);

        $quiz = Quiz::create($request->only('course_id','title','question'));
        return response()->json($quiz,201);
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('course');
        return response()->json($quiz);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'title'=>'required|string|max:255',
            'question'=>'required|string',
        ]);

        $quiz->update($request->only('course_id','title','question'));
        return response()->json($quiz);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return response()->json(['message'=>'Quiz deleted']);
    }
}
