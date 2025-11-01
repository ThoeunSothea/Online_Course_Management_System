<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        return response()->json(Material::with('course')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'file'=>'required|file',
            'file_type'=>'required|string|max:50'
        ]);

        $path = $request->file('file')->store('materials','public');

        $material = Material::create([
            'course_id'=>$request->course_id,
            'file_type'=>$request->file_type,
            'file_path'=>$path,
            'upload_at'=>now()
        ]);

        return response()->json($material,201);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        if(Storage::disk('public')->exists($material->file_path)){
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();
        return response()->json(['message'=>'Material deleted']);
    }
}
