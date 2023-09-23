<?php

namespace App\Http\Controllers;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    
    public function addInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dateOfBirth' => 'required',
            'location' => 'required',
            'occupation' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'aboutMeDescription' => 'required',
            'contactMeDescription' => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $info = new Information();
        $info->fname = $request->input('fname');
        $info->lname = $request->input('lname');
        $info->dateOfBirth = $request->input('dateOfBirth');
        $info->location = $request->input('location');
        $info->occupation = $request->input('occupation');
        $info->email = $request->input('email');
        $info->phone = $request->input('phone');
        $info->image=$request->file('image')->store('images');
        $info->aboutMeDescription = $request->input('aboutMeDescription');
        $info->contactMeDescription = $request->input('contactMeDescription');
        $info->save();

        return response()->json(['success'], 200);
    }

    public function displayInformation(){
        return Information::all();
    }

    public function updateInformation( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dateOfBirth' => 'required',
            'location' => 'required',
            'occupation' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
            'aboutMeDescription' => 'required',
            'contactMeDescription' => 'required', 
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $info = Information::findOrFail($id);
        $info->fname = $request->input('fname');
        $info->lname = $request->input('lname');
        $info->dateOfBirth = $request->input('dateOfBirth');
        $info->location = $request->input('location');
        $info->occupation = $request->input('occupation');
        $info->email = $request->input('email');
        $info->phone = $request->input('phone');
        $info->image=$request->file('image')->store('images');
        $info->aboutMeDescription = $request->input('aboutMeDescription');
        $info->contactMeDescription = $request->input('contactMeDescription');
        $info->save();


       return response()->json(["success"], 200);
}


function displaySpecificInformation($id){
    return Information::find($id);
}

}
