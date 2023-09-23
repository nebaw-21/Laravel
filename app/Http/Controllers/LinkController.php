<?php

namespace App\Http\Controllers;
use App\Models\Link;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function addLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facebook' => 'required',
            'tweeter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
           
           
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $link = new Link();
        $link->facebook = $request->input('facebook');
        $link->tweeter = $request->input('tweeter');
        $link->instagram = $request->input('instagram');
        $link->linkedin = $request->input('linkedin');
     
        $link->save();

        return response()->json(['success'], 200);
    }

    public function displayLink(){
        return Link::all();
    }

    public function updateLink( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'facebook' => 'required',
            'tweeter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $link = Link::findOrFail($id);
       $link->facebook = $request->input('facebook');
       $link->tweeter = $request->input('tweeter');
       $link->instagram = $request->input('instagram');
       $link->linkedin = $request->input('linkedin');
        $link->save();


       return response()->json(["success"], 200);
}


function displaySpecificLink($id){
    return Link::find($id);
}

}
