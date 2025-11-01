<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Quiz;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show dashboard summary for authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if(!$profile){
            return response()->json(['message'=>'Profile not found'],404);
        }

        // Determine role
        $roleName = $user->role->name ?? 'learner';

        $data = [];

        if($roleName === 'admin'){
            $data = [
                'total_users' => User::count(),
                'total_courses' => Course::count(),
                'total_enrollments' => Enrollment::count(),
                'total_assignments' => Assignment::count(),
                'total_quizzes' => Quiz::count(),
            ];
        } elseif($roleName === 'instructor'){
            $instructorCourses = Course::whereHas('instructors', fn($q)=>$q->where('prof_id', $profile->id))->count();
            $assignments = Assignment::whereHas('course', fn($q)=>$q->whereHas('instructors', fn($q2)=>$q2->where('prof_id',$profile->id)))->count();
            $quizzes = Quiz::whereHas('course', fn($q)=>$q->whereHas('instructors', fn($q2)=>$q2->where('prof_id',$profile->id)))->count();

            $data = [
                'my_courses' => $instructorCourses,
                'my_assignments' => $assignments,
                'my_quizzes' => $quizzes,
            ];
        } else { // learner
            $enrolledCourses = Enrollment::where('prof_id',$profile->id)->count();
            $completedAssignments = Assignment::whereHas('course', fn($q)=>$q->whereHas('enrollments', fn($q2)=>$q2->where('prof_id',$profile->id)))->count();
            $quizzesTaken = Quiz::whereHas('course', fn($q)=>$q->whereHas('enrollments', fn($q2)=>$q2->where('prof_id',$profile->id)))->count();

            $data = [
                'enrolled_courses' => $enrolledCourses,
                'assignments_to_complete' => $completedAssignments,
                'quizzes_taken' => $quizzesTaken,
            ];
        }

        return response()->json([
            'role'=>$roleName,
            'dashboard'=>$data
        ]);
    }
}
