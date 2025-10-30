<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::with('category','instructor')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required|exists:course_categories,id',
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'status'=>'required|string|in:draft,pending,approved,rejected,published,archived'
        ]);

        $course = Course::create([
            'instructor_id'=>Auth::id(),
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status
        ]);

        return response()->json($course,201);
    }

    public function show(Course $course)
    {
        return response()->json($course->load('category','instructor'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'category_id'=>'required|exists:course_categories,id',
            'title'=>'required|string|max:255',
            'description'=>'required|string',
            'status'=>'required|string|in:draft,pending,approved,rejected,published,archived'
        ]);
        $course->update($request->only('category_id','title','description','status'));
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message'=>'Course deleted']);
    }
}
