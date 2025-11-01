<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RequestCourse;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestCourseController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $requests = RequestCourse::with('approval')->where('prof_id',$profile->id)->get();
        return response()->json($requests);
    }

    public function store(Request $request)
    {
        $request->validate([
            'approval_id'=>'required|exists:approvals,id'
        ]);

        $profile = Profile::where('user_id',Auth::id())->first();

        $requestCourse = RequestCourse::create([
            'prof_id'=>$profile->id,
            'approval_id'=>$request->approval_id
        ]);

        return response()->json($requestCourse,201);
    }

    public function destroy($id)
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $requestCourse = RequestCourse::where('id',$id)->where('prof_id',$profile->id)->firstOrFail();
        $requestCourse->delete();
        return response()->json(['message'=>'Request deleted']);
    }
}
