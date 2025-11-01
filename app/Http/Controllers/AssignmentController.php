<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('course','type')->get();
        return response()->json($assignments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'type_id'=>'required|exists:type_works,id',
            'title'=>'required|string|max:255',
            'due_date'=>'required|date',
            'max_score'=>'required|numeric|min:0'
        ]);

        $assignment = Assignment::create($request->only('course_id','type_id','title','due_date','max_score'));
        return response()->json($assignment,201);
    }

    public function show(Assignment $assignment)
    {
        $assignment->load('course','type');
        return response()->json($assignment);
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'type_id'=>'required|exists:type_works,id',
            'title'=>'required|string|max:255',
            'due_date'=>'required|date',
            'max_score'=>'required|numeric|min:0'
        ]);

        $assignment->update($request->only('course_id','type_id','title','due_date','max_score'));
        return response()->json($assignment);
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        return response()->json(['message'=>'Assignment deleted']);
    }
}
