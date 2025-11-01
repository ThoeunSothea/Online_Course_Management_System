<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourseCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class CourseCartController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $carts = CourseCart::with('course')->where('prof_id',$profile->id)->get();
        return response()->json($carts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
        ]);

        $profile = Profile::where('user_id',Auth::id())->first();

        $exists = CourseCart::where('course_id',$request->course_id)
            ->where('prof_id',$profile->id)
            ->exists();

        if($exists){
            return response()->json(['message'=>'Already in cart'],409);
        }

        $cart = CourseCart::create([
            'course_id'=>$request->course_id,
            'prof_id'=>$profile->id
        ]);

        return response()->json($cart,201);
    }

    public function destroy($id)
    {
        $profile = Profile::where('user_id',Auth::id())->first();
        $cart = CourseCart::where('id',$id)->where('prof_id',$profile->id)->firstOrFail();
        $cart->delete();
        return response()->json(['message'=>'Removed from cart']);
    }
}
