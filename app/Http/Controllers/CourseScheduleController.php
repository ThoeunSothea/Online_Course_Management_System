<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseSchedule;
use Illuminate\Http\Request;

class CourseScheduleController extends Controller
{
    public function index()
    {
        return response()->json(CourseSchedule::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_time'=>'required|string|max:100'
        ]);

        $schedule = CourseSchedule::create([
            'schedule_time'=>$request->schedule_time
        ]);

        return response()->json($schedule,201);
    }

    public function show(CourseSchedule $courseSchedule)
    {
        return response()->json($courseSchedule);
    }

    public function update(Request $request, CourseSchedule $courseSchedule)
    {
        $request->validate([
            'schedule_time'=>'required|string|max:100'
        ]);

        $courseSchedule->update(['schedule_time'=>$request->schedule_time]);
        return response()->json($courseSchedule);
    }

    public function destroy(CourseSchedule $courseSchedule)
    {
        $courseSchedule->delete();
        return response()->json(['message'=>'Schedule deleted']);
    }
}
