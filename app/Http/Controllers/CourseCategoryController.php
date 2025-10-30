<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index()
    {
        return response()->json(CourseCategory::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:100|unique:course_categories,name',
        ]);

        $category = CourseCategory::create([
            'name'=>$request->name
        ]);

        return response()->json($category,201);
    }

    public function show(CourseCategory $courseCategory)
    {
        return response()->json($courseCategory);
    }

    public function update(Request $request, CourseCategory $courseCategory)
    {
        $request->validate([
            'name'=>'required|string|max:100|unique:course_categories,name,'.$courseCategory->id
        ]);

        $courseCategory->update(['name'=>$request->name]);
        return response()->json($courseCategory);
    }

    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();
        return response()->json(['message'=>'Category deleted']);
    }
}
