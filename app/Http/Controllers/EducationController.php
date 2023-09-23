<?php

namespace App\Http\Controllers;
use App\Models\Education;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    public function addEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'education' => 'required',
            'date' => 'required',
            'description' => 'required',   
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $edu = new Education();
        $edu->education = $request->input('education');
        $edu->date = $request->input('date');
        $edu->description = $request->input('description');
        $edu->save();

        return response()->json(['success'], 200);
    }

    public function displayEducation(){
        return Education::all();
    }

    public function updateEducation( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'education' => 'required',
            'date' => 'required',
            'description' => 'required',  
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $edu = Education::findOrFail($id);
       $edu->education = $request->input('education');
       $edu->date = $request->input('date');
       $edu->description = $request->input('description');
       $edu->save();

       return response()->json(["success"], 200);
}


function displaySpecificEducation($id){
    return Education::find($id);
}

function deleteEducation($id){
    return Education::where('id', $id)->delete();

}
    
}
