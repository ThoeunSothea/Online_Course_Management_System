<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        return response()->json(Approval::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'status'=>'required|string|max:50'
        ]);

        $approval = Approval::create([
            'status'=>$request->status
        ]);

        return response()->json($approval,201);
    }

    public function show(Approval $approval)
    {
        return response()->json($approval);
    }

    public function update(Request $request, Approval $approval)
    {
        $request->validate([
            'status'=>'required|string|max:50'
        ]);

        $approval->update(['status'=>$request->status]);
        return response()->json($approval);
    }

    public function destroy(Approval $approval)
    {
        $approval->delete();
        return response()->json(['message'=>'Approval deleted']);
    }
}
