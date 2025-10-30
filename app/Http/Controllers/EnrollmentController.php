<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $enrollments = Enrollment::with('course')->where('prof_id',$profile->id)->get();
        return response()->json($enrollments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
        ]);

        $profile = Profile::where('user_id',Auth::id())->first();

        $exists = Enrollment::where('course_id',$request->course_id)
            ->where('prof_id',$profile->id)
            ->exists();

        if($exists){
            return response()->json(['message'=>'Already enrolled'],409);
        }

        $enrollment = Enrollment::create([
            'course_id'=>$request->course_id,
            'prof_id'=>$profile->id,
            'enrollment_date'=>now(),
        ]);

        return response()->json($enrollment,201);
    }

    public function destroy($id)
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $enrollment = Enrollment::where('id',$id)->where('prof_id',$profile->id)->firstOrFail();
        $enrollment->delete();

        return response()->json(['message'=>'Enrollment removed']);
    }
}
