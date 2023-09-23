<?php

namespace App\Http\Controllers;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function addTestimonial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'description' => 'required',
            'name' => 'required',   
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $testi = new Testimonial();
        $testi->image=$request->file('image')->store('images');
        $testi->description = $request->input('description');
        $testi->name = $request->input('name');
        $testi->save();

        return response()->json(['success'], 200);
    }

    public function displayTestimonial(){
        return Testimonial::all();
    }

    public function updateTestimonial( Request $request, $id){

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'description' => 'required',
            'name' => 'required',   
       ]);

       if ($validator->fails()) {
           return response()->json(['errors' => $validator->errors()], 422);
       }

       $testi = Testimonial::findOrFail($id);
       $testi->image=$request->file('image')->store('images');
        $testi->description = $request->input('description');
        $testi->name = $request->input('name');
        $testi->save();


       return response()->json(["success"], 200);
}


function displaySpecificTestimonial($id){
    return Testimonial::find($id);
}

function deleteTestimonial($id){
    return Testimonial::where('id', $id)->delete();

}

}
