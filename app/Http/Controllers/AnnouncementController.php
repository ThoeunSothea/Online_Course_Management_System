<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $announcements = Announcement::with('course')->where('prof_id',$profile->id)->get();
        return response()->json($announcements);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'message'=>'required|string|max:1000'
        ]);

        $profile = Profile::where('user_id',Auth::id())->first();

        $announcement = Announcement::create([
            'course_id'=>$request->course_id,
            'prof_id'=>$profile->id,
            'message'=>$request->message,
            'sent_at'=>now()
        ]);

        return response()->json($announcement,201);
    }

    public function destroy($id)
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $announcement = Announcement::where('id',$id)->where('prof_id',$profile->id)->firstOrFail();
        $announcement->delete();
        return response()->json(['message'=>'Announcement deleted']);
    }
}
