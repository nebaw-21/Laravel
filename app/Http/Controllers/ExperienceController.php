<?php

namespace App\Http\Controllers;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function addExperience(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'experience' => 'required',
            'date' => 'required',
            'description' => 'required',   
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $exe = new Experience();
        $exe->experience = $request->input('experience');
        $exe->date = $request->input('date');
        $exe->description = $request->input('description');
        $exe->save();

        return response()->json(['success'], 200);
    }

    public function displayExperience(){
        return Experience::all();
    }

    public function updateExperience( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'experience' => 'required',
            'date' => 'required',
            'description' => 'required',  
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $exe = Experience::findOrFail($id);
       $exe->experience = $request->input('experience');
       $exe->date = $request->input('date');
       $exe->description = $request->input('description');
       $exe->save();

       return response()->json(["success"], 200);
}


function displaySpecificExperience($id){
    return Experience::find($id);
}

function deleteExperience($id){
    return Experience::where('id', $id)->delete();

}
}
